<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class newsController extends Controller
{
     public $_sortBy='';
   	public function index(){

          $currentDate = date("Y-m-d");

          $client = new \GuzzleHttp\Client();
          $apiRequest = $client->request('GET', 'https://newsapi.org/v2/everything?q=business&from=' .  $currentDate . '2019-01-11&sortBy=publishedA&apiKey=41d8a8922a9142ada28af235f4c86a35');
          $content=json_decode($apiRequest->getBody()->getContents(), true);
          $businessnews = $content['articles'];

          $apiRequest = $client->request('GET', 'https://newsapi.org/v2/everything?q=politics&from=' . $currentDate . ' .&sortBy=publishedA&apiKey=41d8a8922a9142ada28af235f4c86a35');
          $content=json_decode($apiRequest->getBody()->getContents(), true);
          $politicsnews = $content['articles'];


         $countryNames = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
         
   		return view('worldcountriesnews', compact('countryNames', 'businessnews', 'politicsnews'));

   	}

   	public function bitcoinNews(){

   		$client = new \GuzzleHttp\Client();
          $link = 'https://newsapi.org/v2/everything?q=bitcoin&from=2019-01-12&apiKey=41d8a8922a9142ada28af235f4c86a35';
   		$apiRequest = $client->request('GET', $link);
   		$content=json_decode($apiRequest->getBody()->getContents(), true);
   		$bitcoinnews = $content['articles'];
   		return view('bitcoin', compact('bitcoinnews'));
   	}

     public function filterBitcoinNews(Request $request){
          
          $currentDate = date("Y-m-d");
          $client = new \GuzzleHttp\Client();
          $link = 'https://newsapi.org/v2/everything?q=bitcoin&from=' . $currentDate . '&sortBy=' . $request->sortby . '&apiKey=41d8a8922a9142ada28af235f4c86a35';
          $apiRequest = $client->request('GET', $link);
          $content=json_decode($apiRequest->getBody()->getContents(), true);
          $bitcoinnews = $content['articles'];
          return view('bitcoin', compact('bitcoinnews'));
     }


   	public function countryNews($country){

          $countryCode = $this->codeToCountry($country);
   		$client = new \GuzzleHttp\Client();
   		$apiRequest = $client->request('GET', 'https://newsapi.org/v2/top-headlines?country=' . $countryCode . '&category=business&apiKey=41d8a8922a9142ada28af235f4c86a35');
   		$content=json_decode($apiRequest->getBody()->getContents(), true);
   		$countrynews = $content['articles'];

   		return view('worldcountrynews', compact('countrynews', 'country'));
   	}

      protected function codeToCountry($country){
          if ($country == 'Afghanistan') return 'AF';
          if ($country == 'Aland Islands') return 'AX'; 
          if ($country == 'Albania') return 'AL';
          if ($country == 'Algeria') return 'DZ';
          if ($country == 'American Samoa') return 'AS';
          if ($country == 'Andorra') return 'AD';
          if ($country == 'Angola') return 'AO';
          if ($country == 'Anguilla') return 'AI';
          if ($country == 'Antarctica') return 'AQ';
          if ($country == 'Antigua and Barbuda') return 'AG';
          if ($country == 'Argentina') return 'AR';
          if ($country == 'Armenia') return 'AM';
          if ($country == 'Aruba') return 'AW';
          if ($country == 'Australia') return 'AU';
          if ($country == 'Austria') return 'AT';
          if ($country == 'Azerbaijan') return 'AZ';
          if ($country == 'Bahamas the') return 'BS';
          if ($country == 'Bahrain') return 'BH';
          if ($country == 'Bangladesh') return 'BD';
          if ($country == 'Barbados') return 'BB';
          if ($country == 'Belarus') return 'BY';
          if ($country == 'Belgium') return 'BE';
          if ($country == 'Belize') return 'BZ';
          if ($country == 'Benin') return 'BJ';
          if ($country == 'Bermuda') return 'BM';
          if ($country == 'Bhutan') return 'BT';
          if ($country == 'Bolivia') return 'BO';
          if ($country == 'Bosnia and Herzegovina') return 'BA';
          if ($country == 'Botswana') return 'BW';
          if ($country == 'Bouvet Island (Bouvetoya)') return 'BV';
          if ($country == 'Brazil') return 'BR';
          if ($country == 'British Indian Ocean Territory (Chagos Archipelago)') return 'IO';
          if ($country == 'British Virgin Islands') return 'VG';
          if ($country == 'Brunei Darussalam') return 'BN';
          if ($country == 'Bulgaria') return 'BG';
          if ($country == 'Burkina Faso') return 'BF';
          if ($country == 'Burundi') return 'BI';
          if ($country == 'Cambodia') return 'KH';
          if ($country == 'Cameroon') return 'CM';
          if ($country == 'Canada') return 'CA';
          if ($country == 'Cape Verde') return 'CV';
          if ($country == 'Cayman Islands') return 'KY';
          if ($country == 'Central African Republic') return 'CF';
          if ($country == 'Chad') return 'TD';
          if ($country == 'Chile') return 'CL';
          if ($country == 'China') return 'CN';
          if ($country == 'Christmas Island') return 'CX';
          if ($country == 'Cocos (Keeling) Islands') return 'CC';
          if ($country == 'Colombia') return 'CO';
          if ($country == 'Comoros the') return 'KM';
          if ($country == 'Congo') return 'CD';
          if ($country == 'Congo the') return 'CG';
          if ($country == 'Cook Islands') return 'CK';
          if ($country == 'Costa Rica') return 'CR';
          if ($country == 'Cote d\'Ivoire') return 'CI';
          if ($country == 'Croatia') return 'HR';
          if ($country == 'Cuba') return 'CU';
          if ($country == 'Cyprus') return 'CY';
          if ($country == 'Czech Republic') return 'CZ';
          if ($country == 'Denmark') return 'DK';
          if ($country == 'Djibouti') return 'DJ';
          if ($country == 'Dominica') return 'DM';
          if ($country == 'Dominican Republic') return 'DO';
          if ($country == 'Ecuador') return 'EC';
          if ($country == 'Egypt') return 'EG';
          if ($country == 'El Salvador') return 'SV';
          if ($country == 'Equatorial Guinea') return 'GQ';
          if ($country == 'Eritrea') return 'ER';
          if ($country == 'Estonia') return 'EE';
          if ($country == 'Ethiopia') return 'ET';
          if ($country == 'Faroe Islands') return 'FO';
          if ($country == 'Falkland Islands (Malvinas)') return 'FK';
          if ($country == 'Fiji the Fiji Islands') return 'FJ';
          if ($country == 'Finland') return 'FI';
          if ($country == 'France, French Republic') return 'FR';
          if ($country == 'French Guiana') return 'GF';
          if ($country == 'French Polynesia') return 'PF';
          if ($country == 'French Southern Territories') return 'TF';
          if ($country == 'Gabon') return 'GA';
          if ($country == 'Gambia the') return 'GM';
          if ($country == 'Georgia') return 'GE';
          if ($country == 'Germany') return 'DE';
          if ($country == 'Ghana') return 'GH';
          if ($country == 'Gibraltar') return 'GI';
          if ($country == 'Greece') return 'GR';
          if ($country == 'Greenland') return 'GL';
          if ($country == 'Grenada') return 'GD';
          if ($country == 'Guadeloupe') return 'GP';
          if ($country == 'Guam') return 'GU';
          if ($country == 'Guatemala') return 'GT';
          if ($country == 'Guernsey') return 'GG';
          if ($country == 'Guinea') return 'GN';
          if ($country == 'Guinea-Bissau') return 'GW';
          if ($country == 'Guyana') return 'GY';
          if ($country == 'Haiti') return 'HT';
          if ($country == 'Heard Island and McDonald Islands') return 'HM';
          if ($country == 'Holy See (Vatican City State)') return 'VA';
          if ($country == 'Honduras') return 'HN';
          if ($country == 'Hong Kong') return 'HK';
          if ($country == 'Hungary') return 'HU';
          if ($country == 'Iceland') return 'IS';
          if ($country == 'India') return 'IN';
          if ($country == 'Indonesia') return 'ID';
          if ($country == 'Iran') return 'IR';
          if ($country == 'Iraq') return 'IQ';
          if ($country == 'Ireland') return 'IE';
          if ($country == 'Isle of Man') return 'IM';
          if ($country == 'Israel') return 'IL';
          if ($country == 'Italy') return 'IT';
          if ($country == 'Jamaica') return 'JM';
          if ($country == 'Japan') return 'JP';
          if ($country == 'Jersey') return 'JE';
          if ($country == 'Jordan') return 'JO';
          if ($country == 'Kazakhstan') return 'KZ';
          if ($country == 'Kenya') return 'KE';
          if ($country == 'Kiribati') return 'KI';
          if ($country == 'Korea') return 'KP';
          if ($country == 'Korea') return 'KR';
          if ($country == 'Kuwait') return 'KW';
          if ($country == 'Kyrgyz Republic') return 'KG';
          if ($country == 'Lao') return 'LA';
          if ($country == 'Latvia') return 'LV';
          if ($country == 'Lebanon') return 'LB';
          if ($country == 'Lesotho') return 'LS';
          if ($country == 'Liberia') return 'LR';
          if ($country == 'Libyan Arab Jamahiriya') return 'LY';
          if ($country == 'Liechtenstein') return 'LI';
          if ($country == 'Lithuania') return 'LT';
          if ($country == 'Luxembourg') return 'LU';
          if ($country == 'Macao') return 'MO';
          if ($country == 'Macedonia') return 'MK';
          if ($country == 'Madagascar') return 'MG';
          if ($country == 'Malawi') return 'MW';
          if ($country == 'Malaysia') return 'MY';
          if ($country == 'Maldives') return 'MV';
          if ($country == 'Mali') return 'ML';
          if ($country == 'Malta') return 'MT';
          if ($country == 'Marshall Islands') return 'MH';
          if ($country == 'Martinique') return 'MQ';
          if ($country == 'Mauritania') return 'MR';
          if ($country == 'Mauritius') return 'MU';
          if ($country == 'Mayotte') return 'YT';
          if ($country == 'Mexico') return 'MX';
          if ($country == 'Micronesia') return 'FM';
          if ($country == 'Moldova') return 'MD';
          if ($country == 'Monaco') return 'MC';
          if ($country == 'Mongolia') return 'MN';
          if ($country == 'Montenegro') return 'ME';
          if ($country == 'Montserrat') return 'MS';
          if ($country == 'Morocco') return 'MA';
          if ($country == 'Mozambique') return 'MZ';
          if ($country == 'Myanmar') return 'MM';
          if ($country == 'Namibia') return 'NA';
          if ($country == 'Nauru') return 'NR';
          if ($country == 'Nepal') return 'NP';
          if ($country == 'Netherlands Antilles') return 'AN';
          if ($country == 'Netherlands the') return 'NL';
          if ($country == 'New Caledonia') return 'NC';
          if ($country == 'New Zealand') return 'NZ';
          if ($country == 'Nicaragua') return 'NI';
          if ($country == 'Niger') return 'NE';
          if ($country == 'Nigeria') return 'NG';
          if ($country == 'Niue') return 'NU';
          if ($country == 'Norfolk Island') return 'NF';
          if ($country == 'Northern Mariana Islands') return 'MP';
          if ($country == 'Norway') return 'NO';
          if ($country == 'Oman') return 'OM';
          if ($country == 'Pakistan') return 'PK';
          if ($country == 'Palau') return 'PW';
          if ($country == 'Palestinian Territory') return 'PS';
          if ($country == 'Panama') return 'PA';
          if ($country == 'Papua New Guinea') return 'PG';
          if ($country == 'Paraguay') return 'PY';
          if ($country == 'Peru') return 'PE';
          if ($country == 'Philippines') return 'PH';
          if ($country == 'Pitcairn Islands') return 'PN';
          if ($country == 'Poland') return 'PL';
          if ($country == 'Portugal, Portuguese Republic') return 'PT';
          if ($country == 'Puerto Rico') return 'PR';
          if ($country == 'Qatar') return 'QA';
          if ($country == 'Reunion') return 'RE';
          if ($country == 'Romania') return 'RO';
          if ($country == 'Russian Federation') return 'RU';
          if ($country == 'Rwanda') return 'RW';
          if ($country == 'Saint Barthelemy') return 'BL';
          if ($country == 'Saint Helena') return 'SH';
          if ($country == 'Saint Kitts and Nevis') return 'KN';
          if ($country == 'Saint Lucia') return 'LC';
          if ($country == 'Saint Martin') return 'MF';
          if ($country == 'Saint Pierre and Miquelon') return 'PM';
          if ($country == 'Saint Vincent and the Grenadines') return '';
          if ($country == 'Samoa') return 'WS';
          if ($country == 'San Marino') return 'SM';
          if ($country == 'Sao Tome and Principe') return 'ST';
          if ($country == 'Saudi Arabia') return 'SA';
          if ($country == 'Senegal') return 'SN';
          if ($country == 'Serbia') return 'RS';
          if ($country == 'Seychelles') return 'SC';
          if ($country == 'Sierra Leone') return 'SL';
          if ($country == 'Singapore') return 'SG';
          if ($country == 'Slovakia (Slovak Republic)') return 'SK';
          if ($country == 'Slovenia') return 'SI';
          if ($country == 'Solomon Islands') return 'SB';
          if ($country == 'Somalia, Somali Republic') return 'SO';
          if ($country == 'South Africa') return 'ZA';
          if ($country == 'South Georgia and the South Sandwich Islands') return 'GS';
          if ($country == 'Spain') return 'ES';
          if ($country == 'Sri Lanka') return 'LK';
          if ($country == 'Sudan') return 'SD';
          if ($country == 'Suriname') return 'SR';
          if ($country == 'Svalbard & Jan Mayen Islands') return 'SJ';
          if ($country == 'Swaziland') return 'SZ';
          if ($country == 'Sweden') return 'SE';
          if ($country == 'Switzerland, Swiss Confederation') return 'CH';
          if ($country == 'Syrian Arab Republic') return 'SY';
          if ($country == 'Taiwan') return 'TW';
          if ($country == 'Tajikistan') return 'TJ';
          if ($country == 'Tanzania') return 'TZ';
          if ($country == 'Thailand') return 'TH';
          if ($country == 'Timor-Leste') return 'TL';
          if ($country == 'Togo') return 'TG';
          if ($country == 'Tokelau') return 'TK';
          if ($country == 'Tonga') return 'TO';
          if ($country == 'Trinidad and Tobago') return 'TT';
          if ($country == 'Tunisia') return 'TN';
          if ($country == 'Turkey') return 'TR';
          if ($country == 'Turkmenistan') return 'TM';
          if ($country == 'Turks and Caicos Islands') return 'TC';
          if ($country == 'Tuvalu') return 'TV';
          if ($country == 'Uganda') return 'UG';
          if ($country == 'Ukraine') return 'UA';
          if ($country == 'United Arab Emirates') return 'AE';
          if ($country == 'United Kingdom') return 'GB';
          if ($country == 'United States of America') return 'US';
          if ($country == 'United States Minor Outlying Islands') return 'UM';
          if ($country == 'United States Virgin Islands') return 'VI';
          if ($country == 'Uruguay, Eastern Republic of') return 'UY';
          if ($country == 'Uzbekistan') return 'UZ';
          if ($country == 'Vanuatu') return 'VU';
          if ($country == 'Venezuela') return 'VE';
          if ($country == 'Vietnam') return 'VN';
          if ($country == 'WF') return 'WF';
          if ($country == 'Wallis and Futuna') return 'EH';
          if ($country == 'Yemen') return 'YE';
          if ($country == 'Kosovo') return 'XK';
          if ($country == 'Zambia') return 'ZM';
          if ($country == 'Zimbabwe') return 'ZW';
          return '';
      }

   	public function techcrunchNews(){

   		$client = new \GuzzleHttp\Client();
   		$apiRequest = $client->request('GET', 'https://newsapi.org/v2/top-headlines?sources=techcrunch&apiKey=41d8a8922a9142ada28af235f4c86a35');
   		$content=json_decode($apiRequest->getBody()->getContents(), true);
   		$technews = $content['articles'];
   		return view('techcrunch', compact('technews'));
   	}

     public function filterTechcrunchNews(Request $request){

          $client = new \GuzzleHttp\Client();
          $link = 'https://newsapi.org/v2/top-headlines?sources=techcrunch&sortBy=' . $request->filter . '&apiKey=41d8a8922a9142ada28af235f4c86a35';
          $apiRequest = $client->request('GET', $link);
          $content=json_decode($apiRequest->getBody()->getContents(), true);
          $technews = $content['articles'];
          return view('techcrunch', compact('technews'));
     }

   	public function walstreetNews(){

   		$client = new \GuzzleHttp\Client();
          $filter = '';
   		$apiRequest = $client->request('GET', 'https://newsapi.org/v2/everything?domains=wsj.com&apiKey=41d8a8922a9142ada28af235f4c86a35');
   		$content=json_decode($apiRequest->getBody()->getContents(), true);
   		$walstreetnews = $content['articles'];
   		return view('walstreet', compact('walstreetnews'));
   	}

     public function filterWalstreetNews(Request $request){

          $client = new \GuzzleHttp\Client();
          $link = 'https://newsapi.org/v2/everything?domains=wsj.com&sortBy=' . $request->filter . '&apiKey=41d8a8922a9142ada28af235f4c86a35';
          $apiRequest = $client->request('GET', $link);
          $content=json_decode($apiRequest->getBody()->getContents(), true);
          $walstreetnews = $content['articles'];
          return view('walstreet', compact('walstreetnews'));
     }
}
