<script type="application/ld+json">
{
 "@context" : "https://schema.org/",
 "@type" : "JobPosting",
 "datePosted" : "{{$job['updated_at']}}",
 "validThrough" : "{{$job['post_expired']}}",
 "title" : "{{$job['post_title']}}",
 "employmentType" : "業務委託",
 "jobLocation": [
    @foreach($working_place as $place)
    {
      "@type": "Place",
      "address": {
        "@type": "PostalAddress",
        "addressLocality": "{{$place['city_name']}}",
        "addressRegion": "{{$place['ken_name']}}",
        "addressCountry": "JP"
      }
    },
    @endforeach
  ]
 "baseSalary" : {
  "@type" : "MonetaryAmount",
  "currency" : "JP",
  "value" : {
    "@type" : "QuantitativeValue",
    "value" : "基本給",
    "minValue" : "{{$job['post_payment_text']}}{{ $job['post_is_payment_more'] ? '以上' : ''}}",
    "maxValue" : "{{$job['post_payment_max_text']}}",
    "unitText" : "月額報酬"
  }
 },
 "hiringOrganization" : {
  "@type" : "Organization",
  "name" : "{{$jober_profile['company_name']}}",
  "sameAs" : "",
  "logo" : "{{ asset('images/jober_profile') }}/{{ $jober_profile['company_img'] }}"
 },
 "identifier" : {
  "@type" : "PropertyValue",
  "name" : "株式会社Lic（英文社名：Lic Co., Ltd.）",
  "value" : "{{$job['id']}}"
 }
}
</script>
