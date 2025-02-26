# Sovos E-Fatura, E-Arşiv, E-İrsaliye

### Giriş
 - [Kurulum](#kurulum)
 - [Gereksinimler](#gereksinimler)

 ### E-Fatura İşlemleri
 - [E-Fatura Servisi](#e-fatura-servisi)
 - [E-Fatura, E-İrsaliye Kayıtlı Kullanıcılar Listesi (Zip)](#e-fatura-e-i̇rsaliye-kayıtlı-kullanıcılar-listesi-zip)
 - [E-Fatura Kayıtlı Kullanıcılar Sorgulama](#e-fatura-kayıtlı-kullanıcılar-sorgulama)
 - [E-Fatura Gelen/Giden Faturaları Sorgulama](#e-fatura-gelengiden-faturaları-sorgulama)
 - [E-Fatura Gelen/Giden Fatura PDF veya HTML İndirme](#e-fatura-gelengiden-fatura-pdf-veya-html-i̇ndirme)
 - [E-Fatura Gelen/Giden Fatura UBL İndirme](#e-fatura-gelengiden-fatura-ubl-i̇ndirme)
 - [E-Fatura Zarf (GİB Durum) Sorgulama](#e-fatura-zarf-gib-durum-sorgulama)
 - [E-Fatura Yanıtlarını (KABUL, RED) Sorgulama](#e-fatura-yanıtlarını-kabul-red-sorgulama)
 - [E-Fatura Uygulama Yanıtı UBL Oluşturma](#e-fatura-uygulama-yanıtı-ubl-oluşturma)
 - [E-Fatura UBL Oluşturma](#e-fatura-ubl-oluşturma)
 - [E-Fatura Gönderme](#e-fatura-gönderme)

 ### E-Arşiv İşlemleri
 - [E-Arşiv Servisi](#e-arşiv-servisi)
 - [E-Arşiv Kayıtlı Kullanıcılar Listesi (Zip)](#e-arşiv-kayıtlı-kullanıcılar-listesi-zip)
 - [E-Arşiv Oluşturma](#e-arşiv-oluşturma)
 - [E-Arşiv Gönderme](#e-arşiv-gönderme)
 - [E-Arşiv Zarf Gönderme](#e-arşiv-zarf-gönderme)
 - [E-Arşiv İptal Etme](#e-arşiv-i̇ptal-etme)
 - [E-Arşiv Tekrar Tetikleme](#e-arşiv-tekrar-tetikleme)
 - [E-Arşiv İndirme](#e-arşiv-i̇ndirme)
 - [E-Arşiv İmzalama](#e-arşiv-i̇mzalama)

## Kurulum
```sh
composer require "ahmeti/sovos"
```

## Gereksinimler
 - GuzzleHttp
 - ZipArchive
 - PHP 8.0 veya üzeri

## E-Fatura Servisi

```php

$service = new Ahmeti\Sovos\Api\InvoiceService(
    username: 'WS_KULLANICIADI',
    password: 'WS_SIFRE',
    test: true,
    debug: false
);
```

## E-Fatura, E-İrsaliye Kayıtlı Kullanıcılar Listesi (Zip)

```php
$getRawUserList = new Ahmeti\Sovos\Invoice\GetRawUserList(
    Identifier: 'SORGULAYAN_PK', // SORGULAYAN_PK veya SORGULAYAN_GB
    VKN_TCKN: 'SORGULAYAN_VKN_TCKN',
    Role: 'PK' // PK veya GB
);

$response = $service->GetRawUserListRequest($getRawUserList);

file_put_contents('/path/to/zip-file.zip', base64_decode($response->DocData));
```

## E-Fatura Kayıtlı Kullanıcılar Sorgulama
Liste halinde kayıtlı kullanıcılar listesini dönecektir. Fonksiyonun daha detaylı açıklamasını Sovos Web Servis Dökümanından edinebilirsiniz.

```php
$userListRequest = new Ahmeti\Sovos\Invoice\GetUserList(
    Identifier: 'SORGULAYAN_PK', // SORGULAYAN_PK veya SORGULAYAN_GB
    VKN_TCKN: 'SORGULAYAN_VKN_TCKN',
    Role: 'PK', // PK veya GB
    Filter_VKN_TCKN: 'SORGULANAN_VKN_TCKN'
);

$list = $service->GetUserListRequest($userListRequest);
```

## E-Fatura Gelen/Giden Faturaları Sorgulama
Posta kutunuza gelen faturaları listelemek için tetiklenen fonksiyon. Fonksiyon parametreleri ile ilgili detaylı bilgiyi Sovos E-Fatura Dökümanında bulabilirsiniz.

```php
$getUblRequest = new Ahmeti\Sovos\Invoice\GetUblList(
    Identifier: 'SORGULAYAN_PK', // SORGULAYAN_PK veya SORGULAYAN_GB
    VKN_TCKN: 'SORGULAYAN_VKN_TCKN',
    UUID: 'FATURA_UUID',
    DocType: 'INVOICE', // INVOICE veya ENVOLOPE    
    Type: 'INBOUND', // INBOUND veya OUTBOUND
    FromDate: '2020-01-01T00:00:00+03:00',
    ToDate: '2020-01-01T00:00:00+03:00',
    FromDateSpecified: true,
    ToDateSpecified: true
);
$list = $service->GetUblListRequest($getUblRequest);
```

## E-Fatura Gelen/Giden Fatura PDF veya HTML İndirme
Seçmiş olduğunuz faturanın PDF veya HTML çıktısını almanızı sağlar. Parametreler ile ilgili daha detaylı bilgiyi Sovos E-Fatura dökümanından inceleyebilirsiniz.

```php
$getInvoiceRequest = new Ahmeti\Sovos\Invoice\GetInvoiceView(
    UUID: 'FATURA_UUID',
    Identifier: 'SORGULAYAN_PK', // SORGULAYAN_PK veya SORGULAYAN_GB
    VKN_TCKN: 'SORGULAYAN_VKN_TCKN',
    Type: 'INVOICE', // INVOICE veya ENVOLOPE
    DocType: 'PDF' // PDF, PDF_DEFAULT veya HTML
);

$data = $service->GetInvoiceViewRequest($getInvoiceRequest);
```

## E-Fatura Gelen/Giden Fatura UBL İndirme
Seçmiş olduğunuz faturanın UBL çıktısını almanıza yarar. Parametreler için daha detaylı bilgiyi Sovos E-Fatura Dökümanında bulabilirsiniz.

```php
$getUblRequest = new Ahmeti\Sovos\Invoice\GetUbl(
    Identifier: 'SORGULAYAN_PK', // SORGULAYAN_PK veya SORGULAYAN_GB
    VKN_TCKN: 'SORGULAYAN_VKN_TCKN',
    UUID: 'FATURA_UUID',
    DocType: 'INVOICE', // INVOICE veya ENVOLOPE
    Type: 'UBL',
    Parameters: 'DOC_DATA'
);

$data = $service->GetUblRequest($getUblRequest);
```

## E-Fatura Zarf (GİB Durum) Sorgulama
Seçilen zarfın GİB durumunu (1120-ZARF ARSIVDEN KOPYALANAMADI, 1300-BASARIYLA TAMAMLANDI) sorgulamak için kullanılan fonksiyondur.

```php
$getEnvelopeRequest = new Ahmeti\Sovos\Invoice\GetEnvelopeStatus(
    Identifier: 'SORGULAYAN_PK', // SORGULAYAN_PK veya SORGULAYAN_GB
    VKN_TCKN: 'SORGULAYAN_VKN_TCKN',
    UUID: 'ZARF_UUID', // STRING veya ARRAY
);

$data = $service->GetEnvelopeStatusRequest($getEnvelopeRequest);
```

## E-Fatura Yanıtlarını (KABUL, RED) Sorgulama
Seçilen ETTN kodlarına ait fatura yanıt (KABUL, RED veya YANITSIZ) durumunu sorgulamak için kullanılan fonksiyondur.

```php
$getEnvelopeRequest = new Ahmeti\Sovos\Invoice\GetInvResponses(
    Identifier: 'SORGULAYAN_PK', // SORGULAYAN_PK veya SORGULAYAN_GB
    VKN_TCKN: 'SORGULAYAN_VKN_TCKN',
    UUID: 'ZARF_UUID', // STRING veya ARRAY
    Type: 'OUTBOUND', // INBOUND veya OUTBOUND
);

$data = $service->GetInvResponsesRequest($getEnvelopeRequest);
```

## E-Fatura Uygulama Yanıtı UBL Oluşturma
Örnek bir fatura KABUL uygulama yanıtı örneğidir. Örnekte kullanılan alanlar ve isimler GIB ve Sovos standartlarına göre oluşturulmuştur. Alanların anlamı için GIB ve Sovos dökümanlarını inceleyebilirsiniz.

```php
$appResp = new Ahmeti\Ubl\ApplicationResponse(
    UBLVersionID: '2.1',
    CustomizationID: 'TR1.2',
    ProfileID: 'TICARIFATURA',
    ID: '8e593889-917d-4e45-bef1-41aeff67b2f2',
    UUID: '243639d3-48e6-4b25-a9f2-5a148f855c3e',
    IssueDate: '2021-09-01',
    IssueTime: '00:00:00',
    Note: [],
    Signature: null,
    SenderParty: new Ahmeti\Ubl\SenderParty(
        PartyIdentification: new Ahmeti\Ubl\PartyIdentification(
            ID: ['val' => 'GONDERICI_TCKN_VKN', 'attrs' => ['schemaID="TCKN"']],
        ),
        PartyName: new Ahmeti\Ubl\PartyName(
            Name: 'Ahmet İmamoğlu'
        ),
        PostalAddress: new Ahmeti\Ubl\PostalAddress(
            CitySubdivisionName: 'Nilüfer',
            CityName: 'Bursa',
            Country: new Ahmeti\Ubl\Country(
                Name: 'Türkiye'
            )
        )
    ),
    ReceiverParty: new Ahmeti\Ubl\ReceiverParty(
        PartyIdentification: new Ahmeti\Ubl\PartyIdentification(
            ID: ['val' => 'ALICI_TCKN_VKN', 'attrs' => ['schemaID="TCKN"']],
        ),
        PartyName: new Ahmeti\Ubl\PartyName(
            Name: 'Ahmet İmamoğlu'
        ),
        PostalAddress: new Ahmeti\Ubl\PostalAddress(
            CitySubdivisionName: 'Nilüfer',
            CityName: 'Bursa',
            Country: new Ahmeti\Ubl\Country(
                Name: 'Türkiye'
            )
        )
    ), DocumentResponse: new Ahmeti\Ubl\DocumentResponse(
        Response: new Ahmeti\Ubl\Response(
            ReferenceID: '12345',
            ResponseCode: 'KABUL'
        ),
        DocumentReference: new Ahmeti\Ubl\DocumentReference(
            ID: '8e593889-917d-4e45-bef1-41aeff67b2f2',
            DocumentType: 'FATURA',
            DocumentTypeCode: 'FATURA',
            IssueDate: 'BELGE_TARIHI'
        )
    )
);

$xml = (new Ahmeti\Ubl\Utils\UblInvoice($appResp))->getApplicationResponseXML();
```

## E-Fatura UBL Oluşturma
Örnek bir E-Fatura oluşturmuş olduk bu oluşturduğumuz faturayı Sovos servislerine ileterek faturalaştırmış olacağız. Dikkat etmemiz gereken nokta Fatura UUID ve XML olarak çıktı verir UUID ile faturayı takip edebilirsiniz oluşan XML'i de Sovos sistemine iletebilirsiniz. Alan detayları için GIB ve Sovos dökümanlarına bakınız.

```php
$invoice = new Ahmeti\Ubl\Invoice(
    UBLVersionID: '2.1', // Uluslararası fatura standardı 2.1
    CustomizationID: 'TR1.2', // GİB UBLTR olarak isimlendirdiği Türkiye'ye özgü 1.2 efatura formatını kullanıyor.
    ProfileID: 'TICARIFATURA', // Ticari ve temel olarak iki çeşittir. Ticari faturalarda sistem yanıtı(application response) döner.
    ID: 'FIT2017000000021', // Eğer fatura ID FIT tarafından oluşacak ise, ID alanı boş, CUST_INV_ID alanı dolu gelmelidir. Eğer kullanıcı firma tarafından oluşacak ise, ID alanı dolu CUST_INV_ID alanı boş olarak gönderilmeli.
    CopyIndicator: 'false', // Kopyası mı, asıl süret mi olduğu belirlenir
    UUID: '1d7f3f8b-0b0b-4c8b-8b1f-7f6b1f6b1f6b', // Fatura UUID
    IssueDate: '2021-09-01', // Fatura tarihi Y-m-d
    IssueTime: '12:00:00', // Fatura saati H:i:s
    InvoiceTypeCode: 'SATIS', // Gönderilecek fatura çeşidi, satış, iade vs.
    Note: ['Test not'], // İsteğe bağlı not alanı
    DocumentCurrencyCode: 'TRY', // Efatura para birimi
    LineCountNumeric: 1, // Fatura kalemlerinin sayısı
    AdditionalDocumentReference: [
        // Fatura ID otomatik oluşacak ise bu alanı göndermelisiniz.
        new Ahmeti\Ubl\DocumentReference(
            ID: '000000000000001', // ERP Fatura ID
            IssueDate: '2021-09-01', // Fatura tarihi Y-m-d
            DocumentTypeCode: 'CUST_INV_ID' // Fatura tipi
        ),
    ],
    AccountingSupplierParty: new Ahmeti\Ubl\AccountingSupplierParty(
        Party: new Ahmeti\Ubl\Party(
            WebsiteURI: 'https://ahmeti.com.tr',
            PartyIdentification: new Ahmeti\Ubl\PartyIdentification(
                ID: ['val' => '12345678901', 'attrs' => ['schemeID="VKN"']]
            ),
            PartyName: new Ahmeti\Ubl\PartyName(
                Name: 'Ahmet İmamoğlu'
            ),
            Person: new Ahmeti\Ubl\Person(
                FirstName: 'Ahmet',
                FamilyName: 'İmamoğlu'
            ),
            PostalAddress: new Ahmeti\Ubl\PostalAddress(
                Room: 'kapi no',
                StreetName: 'cadde',
                BuildingName: 'bina',
                BuildingNumber: 'bina no',
                CitySubdivisionName: 'mahalle',
                CityName: 'şehir',
                PostalZone: 'posta kodu',
                Region: 'bölge',
                Country: new Ahmeti\Ubl\Country(
                    Name: 'Türkiye'
                )
            ),
            PartyTaxScheme: new Ahmeti\Ubl\PartyTaxScheme(
                TaxScheme: new Ahmeti\Ubl\TaxScheme(
                    Name: 'Nilüfer'
                )
            ),
            Contact: new Ahmeti\Ubl\Contact(
                Telephone: 'telefon',
                Telefax: 'faks',
                ElectronicMail: 'mail adresi'
            )
        )
    ),
    AccountingCustomerParty: new Ahmeti\Ubl\AccountingCustomerParty(
        Party: new Ahmeti\Ubl\Party(
            WebsiteURI: 'https://ahmeti.com.tr',
            PartyIdentification: new Ahmeti\Ubl\PartyIdentification(
                ID: ['val' => '12345678901', 'attrs' => ['schemeID="VKN"']]
            ),
            PartyName: new Ahmeti\Ubl\PartyName(
                Name: 'GIB'
            ),
            Person: new Ahmeti\Ubl\Person(
                FirstName: 'ADI',
                FamilyName: 'SOYADI'
            ),
            PostalAddress: new Ahmeti\Ubl\PostalAddress(
                Room: 'kapi no',
                StreetName: 'cadde',
                BuildingName: 'bina',
                BuildingNumber: 'bina no',
                CitySubdivisionName: 'mahalle',
                CityName: 'şehir',
                PostalZone: 'posta kodu',
                Region: 'asd',
                Country: new Ahmeti\Ubl\Country(
                    Name: 'Türkiye'
                )
            ),
            PartyTaxScheme: new Ahmeti\Ubl\PartyTaxScheme(
                TaxScheme: new Ahmeti\Ubl\TaxScheme(
                    Name: 'Nilüfer'
                )
            ),
            Contact: new Ahmeti\Ubl\Contact(
                Telephone: 'telefon',
                Telefax: 'faks',
                ElectronicMail: 'mail adresi'
            )
        )
    ),
    AllowanceCharge: new Ahmeti\Ubl\AllowanceCharge(
        ChargeIndicator: false,
        Amount: ['val' => '0.01', 'attrs' => ['currencyID="TRY"']]
    ),
    TaxTotal: new Ahmeti\Ubl\TaxTotal(
        TaxAmount: ['val' => '0.01', 'attrs' => ['currencyID="TRY"']],
        TaxSubtotal: new Ahmeti\Ubl\TaxSubtotal(
            TaxableAmount: ['val' => '0.99', 'attrs' => ['currencyID="TRY"']],
            TaxAmount: ['val' => '0.01', 'attrs' => ['currencyID="TRY"']],
            TaxCategory: new Ahmeti\Ubl\TaxCategory(
                TaxScheme: new Ahmeti\Ubl\TaxScheme(
                    Name: 'KDV',
                    TaxTypeCode: '0015'
                )
            )
        )
    ),
    LegalMonetaryTotal: new Ahmeti\Ubl\LegalMonetaryTotal(
        LineExtensionAmount: ['val' => '1', 'attrs' => ['currencyID="TRY"']],
        TaxExclusiveAmount: ['val' => '0.99', 'attrs' => ['currencyID="TRY"']],
        TaxInclusiveAmount: ['val' => '1', 'attrs' => ['currencyID="TRY"']],
        AllowanceTotalAmount: ['val' => '0.01', 'attrs' => ['currencyID="TRY"']],
        PayableAmount: ['val' => '1', 'attrs' => ['currencyID="TRY"']]
    ),
    InvoiceLine: [
        new Ahmeti\Ubl\InvoiceLine(
            ID: '1',
            InvoicedQuantity: ['val' => '1', 'attrs' => ['unitCode="CMT"']],
            LineExtensionAmount: ['val' => '0.99', 'attrs' => ['currencyID="TRY"']],
            AllowanceCharge: new Ahmeti\Ubl\AllowanceCharge(
                ChargeIndicator: false,
                MultiplierFactorNumeric: '0.01',
                Amount: ['val' => '0.01', 'attrs' => ['currencyID="TRY"']],
                BaseAmount: ['val' => '1', 'attrs' => ['currencyID="TRY"']],
            ),
            TaxTotal: new Ahmeti\Ubl\TaxTotal(
                TaxAmount: ['val' => '0.01', 'attrs' => ['currencyID="TRY"']],
                TaxSubtotal: new Ahmeti\Ubl\TaxSubtotal(
                    TaxableAmount: ['val' => '0.99', 'attrs' => ['currencyID="TRY"']],
                    TaxAmount: ['val' => '0.01', 'attrs' => ['currencyID="TRY"']],
                    Percent: 18,
                    TaxCategory: new Ahmeti\Ubl\TaxCategory(
                        TaxScheme: new Ahmeti\Ubl\TaxScheme(
                            Name: 'KDV',
                            TaxTypeCode: '0015'
                        )
                    )
                )
            ),
            Item: new Ahmeti\Ubl\Item(
                Name: 'Test Ürün',
                Description: 'Test Ürün Açıklaması',
            ),
            Price: new Ahmeti\Ubl\Price(
                PriceAmount: ['val' => '1', 'attrs' => ['currencyID="TRY"']]
            )
        ),
    ]
);

$xml = (new Ahmeti\Ubl\Utils\UblInvoice($invoice))->getXML();
```

## E-Fatura Gönderme
Aşağıda oluşturmuş olduğumuz XML (UBL) dosyası son senaryo olarak faturalaştırmak için Sovos servislerine göndermek için kullandığımız fonksiyon. Burada dikkat edilmesi gereken nokta. Zip dosyası oluşturup bu oluşturduğumuz ZIP dosyası ve fatura UUID aynı olmasıdır ve ZIP dosyasını BASE64 yapıp Sovosya gönderiyoruz ve cevabını alıyoruz.

Genel olarak dikkat etmemiz gerekenler Sovos ve GIB dökümanlarını inceleyerek oradaki isimler ve sınıflarımız aynı isimdedir. UBL oluşturup cevabını alabilirsiniz.

```php
$destination = 'temp/'.$uuid.'.zip';
$zip = new ZipArchive();
if($zip->open($destination, ZIPARCHIVE::CREATE) !== true) {
    return false;
}
$zip->addFromString($uuid.'.xml', $xml);
$zip->close();

$sendUblRequest = new Ahmeti\Sovos\Invoice\SendUBL(
    VKN_TCKN: 'GONDERICI_VKN_TCKN',
    DocType: 'INVOICE',
    ReceiverIdentifier: 'ALICI_PK',
    SenderIdentifier: 'GONDERICI_GB',
    DocData: base64_encode(file_get_contents($destination))
);

unlink($destination);

$result = $service->SendUBLRequest($sendUblRequest);
```

## E-Arşiv Servisi

```php

$service = new Ahmeti\Sovos\Api\ArchiveService(
    username: 'EARSIV_WS_Kullanici',
    password: 'EARSIV_WS_Sifre',
    test: true
);
// Son parametre, TEST ortamında ise true yapabilirsiniz veya boş bırakabilirsiniz.
```

## E-Arşiv Kayıtlı Kullanıcılar Listesi (Zip)
Kayıtlı kullanıcılar listesini ZIP olarak dönüş yapar.

```php
$getDocument = new Ahmeti\Sovos\Archive\GetUserList(
    vknTckn: 'GONDERICI_VKN_TCKN',
);

$result = $service->GetUserListRequest($getDocument);
```

## E-Arşiv Oluşturma
Örnek E-Arşiv faturası oluşturmak için kullanılan parametre ve değişkenlerin açıklamaları için Sovos E-Arşiv dökümanına veya GIB dökümanına göz atabilirsiniz.

```php
$invoice = new Ahmeti\Ubl\Invoice(
    UBLVersionID: '2.1', // Uluslararası fatura standardı 2.1
    CustomizationID: 'TR1.2', // GİB UBLTR olarak isimlendirdiği Türkiye'ye özgü 1.2 efatura formatını kullanıyor.
    ProfileID: 'EARSIVFATURA',
    ID: 'FA02017000000021', // Eğer fatura ID FIT tarafından oluşacak ise, ID alanı boş, CUST_INV_ID alanı dolu gelmelidir. Eğer kullanıcı firma tarafından oluşacak ise, ID alanı dolu CUST_INV_ID alanı boş olarak gönderilmeli.
    CopyIndicator: false, // Kopyası mı, asıl süret mi olduğu belirlenir
    UUID: '1d8e1b1b-4b3b-4e3f-8b1f-0e2f1b1b2c1d', // Fatura UUID
    IssueDate: '2021-09-01', // Fatura tarihi
    IssueTime: '10:00:00', // Fatura saati
    InvoiceTypeCode: 'SATIS', // Gönderilecek fatura çeşidi, satış, iade vs.
    DocumentCurrencyCode: 'TRY', // E-fatura para birimi
    LineCountNumeric: 1, // Fatura kalemlerinin sayısı
    Note: ['Test not'], // İsteğe bağlı not alanı
    AdditionalDocumentReference: [
        // Fatura ID otomatik oluşacak ise bu alanı göndermelisiniz.
        new Ahmeti\Ubl\DocumentReference(
            ID: '000000000000001', // ERP Fatura ID
            IssueDate: '2021-09-01', // Fatura tarihi Y-m-d
            DocumentTypeCode: 'CUST_INV_ID' // Fatura tipi
        ),
        new Ahmeti\Ubl\DocumentReference(
            ID: '0100',
            IssueDate: '2021-09-01',
            DocumentTypeCode: 'OUTPUT_TYPE'
        ),
        new Ahmeti\Ubl\DocumentReference(
            ID: 'KAGIT',
            IssueDate: '2021-09-01',
            DocumentTypeCode: 'EREPSENDT'
        ),
    ],
    Signature: new Ahmeti\Ubl\Signature(
        ID: ['val' => 'ALICI_VKN_TCKN', 'attrs' => ['schemeID = "VKN_TCKN"']],
        SignatoryParty: new Ahmeti\Ubl\SignatoryParty(
            PartyIdentification: new Ahmeti\Ubl\PartyIdentification(
                ID: ['val' => 'ALICI_VKN_TCKN', 'attrs' => ['schemeID = "VKN"']]
            ),
            PostalAddress: new Ahmeti\Ubl\PostalAddress(
                StreetName: 'deneme cad',
                BuildingName: '01',
                CitySubdivisionName: 'ilce',
                CityName: 'il',
                PostalZone: '34000',
                Country: new Ahmeti\Ubl\Country(
                    Name: 'TÜRKİYE'
                )
            )
        ),
        DigitalSignatureAttachment: new Ahmeti\Ubl\DigitalSignatureAttachment(
            ExternalReference: new Ahmeti\Ubl\ExternalReference(
                URI: '#Signature'
            )
        )
    ),
    AccountingSupplierParty: new Ahmeti\Ubl\AccountingSupplierParty(
        Party: new Ahmeti\Ubl\Party(
            WebsiteURI: 'https://ahmeti.com.tr',
            PartyIdentification: new Ahmeti\Ubl\PartyIdentification(
                ID: ['val' => 'GONDERICI_VKN_TCKN', 'attrs' => ['schemeID="TCKN"']]
            ),
            PartyName: new Ahmeti\Ubl\PartyName(
                Name: 'Ahmet İmamoğlu'
            ),
            Person: new Ahmeti\Ubl\Person(
                FirstName: 'Ahmet',
                FamilyName: 'İmamoğlu'
            ),
            PostalAddress: new Ahmeti\Ubl\PostalAddress(
                Room: 'kapi no',
                StreetName: 'cadde',
                BuildingName: 'bina',
                BuildingNumber: 'bina no',
                CitySubdivisionName: 'mahalle',
                CityName: 'şehir',
                PostalZone: 'posta kodu',
                Region: 'asd',
                Country: new Ahmeti\Ubl\Country(
                    Name: 'Türkiye'
                )
            ),
            PartyTaxScheme: new Ahmeti\Ubl\PartyTaxScheme(
                TaxScheme: new Ahmeti\Ubl\TaxScheme(
                    Name: 'Nilüfer'
                )
            ),
            Contact: new Ahmeti\Ubl\Contact(
                Telephone: 'telefon',
                Telefax: 'faks',
                ElectronicMail: 'mail adresi'
            )
        )
    ),
    AccountingCustomerParty: new Ahmeti\Ubl\AccountingCustomerParty(
        Party: new Ahmeti\Ubl\Party(
            WebsiteURI: 'http://unlembilisim.com',
            PartyIdentification: new Ahmeti\Ubl\PartyIdentification(
                ID: ['val' => 'ALICI_VKN_TCKN', 'attrs' => ['schemeID="TCKN"']]
            ),
            PartyName: new Ahmeti\Ubl\PartyName(
                Name: 'ALICI UNVANI'
            ),
            Person: new Ahmeti\Ubl\Person(
                FirstName: 'ALICI ADI',
                FamilyName: 'ALICI SOYADI'
            ),
            PostalAddress: new Ahmeti\Ubl\PostalAddress(
                Room: 'kapi no',
                StreetName: 'cadde',
                BuildingName: 'bina',
                BuildingNumber: 'bina no',
                CitySubdivisionName: 'mahalle',
                CityName: 'şehir',
                PostalZone: 'posta kodu',
                Region: 'asd',
                Country: new Ahmeti\Ubl\Country(
                    Name: 'Türkiye'
                )
            ),
            PartyTaxScheme: new Ahmeti\Ubl\PartyTaxScheme(
                TaxScheme: new Ahmeti\Ubl\TaxScheme(
                    Name: 'Nilüfer'
                )
            ),
            Contact: new Ahmeti\Ubl\Contact(
                Telephone: 'telefon',
                Telefax: 'faks',
                ElectronicMail: 'mail adresi'
            )
        )
    ),
    TaxTotal: new Ahmeti\Ubl\TaxTotal(
        TaxAmount: ['val' => '0.01', 'attrs' => ['currencyID="TRY"']],
        TaxSubtotal: new Ahmeti\Ubl\TaxSubtotal(
            TaxableAmount: ['val' => '0.99', 'attrs' => ['currencyID="TRY"']],
            TaxAmount: ['val' => '0.01', 'attrs' => ['currencyID="TRY"']],
            TaxCategory: new Ahmeti\Ubl\TaxCategory(
                TaxScheme: new Ahmeti\Ubl\TaxScheme(
                    Name: 'KDV',
                    TaxTypeCode: '0015'
                )
            )
        )
    ),
    LegalMonetaryTotal: new Ahmeti\Ubl\LegalMonetaryTotal(
        LineExtensionAmount: ['val' => '1', 'attrs' => ['currencyID="TRY"']],
        TaxExclusiveAmount: ['val' => '0.99', 'attrs' => ['currencyID="TRY"']],
        TaxInclusiveAmount: ['val' => '1', 'attrs' => ['currencyID="TRY"']],
        PayableAmount: ['val' => '1', 'attrs' => ['currencyID="TRY"']]
    ),
    InvoiceLine: [
        new Ahmeti\Ubl\InvoiceLine(
            ID: '1',
            InvoicedQuantity: ['val' => '1', 'attrs' => ['unitCode="CMT"']],
            LineExtensionAmount: ['val' => '0.99', 'attrs' => ['currencyID="TRY"']],
            Item: new Ahmeti\Ubl\Item(
                Name: 'Test Ürün'
            ),
            Price: new Ahmeti\Ubl\Price(
                PriceAmount: ['val' => '1', 'attrs' => ['currencyID="TRY"']]
            )
        ),
    ]
);

$xml = (new Ahmeti\Ubl\Utils\UblInvoice($invoice))->getXML();
```

## E-Arşiv Gönderme
Oluşturmuş olduğumuz E-Arşiv XML'ini Sovos sistemlerine göndermek için kullandığımız fonksiyon.

```php
$destination = 'temp/'.$rand.'.zip';
$rand = rand(1000,9999);
$zip = new ZipArchive();
if($zip->open($destination, ZIPARCHIVE::CREATE) !== true) {
    return false;
}
$zip->addFromString($uuid.'.xml', $xml);
$zip->close();

$sendUblRequest = new Ahmeti\Sovos\Archive\SendInvoice(
    senderID: 'GONDERICI_VKN_TCKN',
    hash: md5_file($destination),
    fileName: $rand.'.zip',
    docType: 'XML',
    binaryData: base64_encode(file_get_contents($destination)),
    customizationParams: [new Ahmeti\Sovos\Archive\CustomizationParam(
        paramName: 'BRANCH',
        paramValue: 'default'
    )],
    responsiveOutput: new Ahmeti\Sovos\Archive\responsiveOutput(
        outputType: 'PDF'
    )
);

$result = $service->SendInvoiceRequest($sendUblRequest);
```

## E-Arşiv Zarf Gönderme
Detaylar için Sovos E-Arşiv dökümanını inceleyebilirsiniz.

```php
$destination = 'temp/'.$rand.'.zip';
$rand = rand(1000, 9999);
$zip = new ZipArchive;
if ($zip->open($destination, ZIPARCHIVE::CREATE) !== true) {
    return false;
}
$zip->addFromString($uuid.'.xml', $xml);
$zip->close();

$sendUblRequest = new Ahmeti\Sovos\Archive\SendEnvelope(
    senderID: 'GONDERICI_VKN_TCKN',
    hash: md5_file($destination),
    fileName: $rand.'.zip',
    docType: 'XML',
    binaryData: base64_encode(file_get_contents($destination)),
    customizationParams: [new Ahmeti\Sovos\Archive\CustomizationParam(
        paramName: 'BRANCH',
        paramValue: 'default',
    )]
);

$result = $service->SendEnvelopeRequest($sendUblRequest);
```

## E-Arşiv İptal Etme
Gerekli alanları doldurarak faturayı iptal edebiliriz. Değişkenleri Sovos dökümanından kontrol edebilirsiniz.

```php
$cancelInvoice = new Ahmeti\Sovos\Archive\CancelInvoice(
    invoiceCancelInfoTypeList: [new Ahmeti\Sovos\Archive\InvoiceCancelInfoTypeList(
        invoiceId: 'INVOICE_NUMBER',
        vkn: 'GONDERICI_VKN',
        branch: 'GONDEREN_SUBE',
        totalAmount: 'FATURA_TUTARI',
        cancelDate: 'Y-m-d',
        custInvID: 'CUST_INV_ID'
    )]
);

$resutl = $service->CancelInvoiceRequest($cancelInvoice);
```

## E-Arşiv Tekrar Tetikleme
Gönderilmiş bir faturayı tekrar iletmek için kullanılan fonksiyon CustomParameters için Sovos dökümanlarına göz atınız.

```php
$retriggerOperation = new Ahmeti\Sovos\Archive\RetriggerOperation(
    VKN: 'GONDERICI_VKN_TCKN',
    branch: 'GONDERICI_SUBE',
    invoiceID: 'FATURA_NUMARASI',
    invoiceUUID: 'FATURA_UUID',
    customizationParams: [
        new Ahmeti\Sovos\Archive\CustomizationParam(
            paramName: '',
            paramValue: ''
        )
    ]
);

$result = $service->GetRetriggerOperationRequest($retriggerOperation);
```

## E-Arşiv İndirme
Fonksiyonu tetikleyerek göndermiş olduğunuz faturanın görselini indirebilirsiniz.

```php
$invoice = new Ahmeti\Sovos\Archive\GetInvoiceDocument(
    UUID: 'FATURA_UUID',
    vkn: 'GONDERICI_VKN',
    invoiceNumber: 'FATURA_NUMARASI',
    custInvId: 'CUST_INV_ID',
    outputType: 'CIKTI_TURU' // XML, UBL
);

$result = $service->GetInvoiceDocumentRequest($invoice);
```

## E-Arşiv İmzalama
Fonksiyonu tetikleyerek imzalama işlemi gerçekleştirebilirsiniz. SDK'da kullanılan tüm fonksiyon ve değişken isimleri Sovos ve GIB sistemine uygundur. Sovos ve GIB dökümanlarını inceleyerek kolaylıkla entegrasyon sağlayabilirsiniz.

```php
$getDocument = new Ahmeti\Sovos\Archive\GetSignedInvoice(
    UUID: 'FATURA_UUID',
    vkn: 'GONDERICI_VKN',
    invoiceNumber: 'FATURA_NUMARASI',
    custInvID: 'CUST_INV_ID'
);

$resutl = $service->GetSignedInvoiceRequest($getDocument);
```
