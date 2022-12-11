<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrenciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencies')->insert([
    		[
                'id' => 1,
                'name' => 'Algeria',
                'code' => 'DZ',
                'dial_code' => '+213',
                'currency_name' => 'Algerian dinar',
                'currency_symbol' => 'دج  ',
                'currency_code' => 'DZD'
            ],
            [
                'id' => 2,
                'name' => 'Argentina',
                'code' => 'AR',
                'dial_code' => '+54',
                'currency_name' => 'Argentine peso',
                'currency_symbol' => '$',
                'currency_code' => 'ARS'
            ],
            [
                'id' => 3,
                'name' => 'Aruba',
                'code' => 'AW',
                'dial_code' => '+297',
                'currency_name' => 'Aruban florin',
                'currency_symbol' => 'ƒ',
                'currency_code' => 'AWG'
            ],
            [
                'id' => 4,
                'name' => 'Australia',
                'code' => 'AU',
                'dial_code' => '+61',
                'currency_name' => 'Australian dollar',
                'currency_symbol' => '$',
                'currency_code' => 'AUD'
            ],
            [
                'id' => 5,
                'name' => 'Austria',
                'code' => 'AT',
                'dial_code' => '+43',
                'currency_name' => 'Euro',
                'currency_symbol' => '€',
                'currency_code' => 'EUR'
            ],
            [
                'id' => 6,
                'name' => 'Bangladesh',
                'code' => 'BD',
                'dial_code' => '+880',
                'currency_name' => 'Bangladeshi taka',
                'currency_symbol' => '৳',
                'currency_code' => 'BDT'
            ],
            [
                'id' => 7,
                'name' => 'Belarus',
                'code' => 'BY',
                'dial_code' => '+375',
                'currency_name' => 'Belarusian ruble',
                'currency_symbol' => 'Br',
                'currency_code' => 'BYR'
            ],
            [
                'id' => 8,
                'name' => 'Belgium',
                'code' => 'BE',
                'dial_code' => '+32',
                'currency_name' => 'Euro',
                'currency_symbol' => '€',
                'currency_code' => 'EUR'
            ],
            [
                'id' => 9,
                'name' => 'Bermuda',
                'code' => 'BM',
                'dial_code' => '+1441',
                'currency_name' => 'Bermudian dollar',
                'currency_symbol' => '$',
                'currency_code' => 'BMD'
            ],
            [
                'id' => 10,
                'name' => 'Bhutan',
                'code' => 'BT',
                'dial_code' => '+975',
                'currency_name' => 'Bhutanese ngultrum',
                'currency_symbol' => 'Nu.',
                'currency_code' => 'BTN'
            ],
            [
                'id' => 11,
                'name' => 'Botswana',
                'code' => 'BW',
                'dial_code' => '+267',
                'currency_name' => 'Botswana pula',
                'currency_symbol' => 'P',
                'currency_code' => 'BWP'
            ],
            [
                'id' => 12,
                'name' => 'Brazil',
                'code' => 'BR',
                'dial_code' => '+55',
                'currency_name' => 'Brazilian real',
                'currency_symbol' => 'R$',
                'currency_code' => 'BRL'
            ],
            [
                'id' => 13,
                'name' => 'Bulgaria',
                'code' => 'BG',
                'dial_code' => '+359',
                'currency_name' => 'Bulgarian lev',
                'currency_symbol' => 'лв',
                'currency_code' => 'BGN'
            ],
            [
                'id' => 14,
                'name' => 'Cambodia',
                'code' => 'KH',
                'dial_code' => '+855',
                'currency_name' => 'Cambodian riel',
                'currency_symbol' => '៛',
                'currency_code' => 'KHR'
            ],
            [
                'id' => 15,
                'name' => 'Canada',
                'code' => 'CA',
                'dial_code' => '+1',
                'currency_name' => 'Canadian dollar',
                'currency_symbol' => '$',
                'currency_code' => 'CAD'
            ],
            [
                'id' => 16,
                'name' => 'Chad',
                'code' => 'TD',
                'dial_code' => '+235',
                'currency_name' => 'Central African CFA',
                'currency_symbol' => 'Fr',
                'currency_code' => 'XAF'
            ],
            [
                'id' => 17,
                'name' => 'Chile',
                'code' => 'CL',
                'dial_code' => '+56',
                'currency_name' => 'Chilean peso',
                'currency_symbol' => '$',
                'currency_code' => 'CLP'
            ],
            [
                'id' => 18,
                'name' => 'China',
                'code' => 'CN',
                'dial_code' => '+86',
                'currency_name' => 'Chinese yuan',
                'currency_symbol' => '¥ or 元',
                'currency_code' => 'CNY'
            ],
            [
                'id' => 19,
                'name' => 'Colombia',
                'code' => 'CO',
                'dial_code' => '+57',
                'currency_name' => 'Colombian peso',
                'currency_symbol' => '$',
                'currency_code' => 'COP'
            ],
            [
                'id' => 20,
                'name' => 'Costa Rica',
                'code' => 'CR',
                'dial_code' => '+506',
                'currency_name' => 'Costa Rican colón',
                'currency_symbol' => '₡',
                'currency_code' => 'CRC'
            ],
            [
                'id' => 21,
                'name' => 'Croatia',
                'code' => 'HR',
                'dial_code' => '+385',
                'currency_name' => 'Croatian kuna',
                'currency_symbol' => 'kn',
                'currency_code' => 'HRK'
            ],
            [
                'id' => 22,
                'name' => 'Cuba',
                'code' => 'CU',
                'dial_code' => '+53',
                'currency_name' => 'Cuban convertible pe',
                'currency_symbol' => '$',
                'currency_code' => 'CUC'
            ],
            [
                'id' => 23,
                'name' => 'Cyprus',
                'code' => 'CY',
                'dial_code' => '+357',
                'currency_name' => 'Euro',
                'currency_symbol' => '€',
                'currency_code' => 'EUR'
            ],
            [
                'id' => 24,
                'name' => 'Denmark',
                'code' => 'DK',
                'dial_code' => '+45',
                'currency_name' => 'Danish krone',
                'currency_symbol' => 'kr',
                'currency_code' => 'DKK'
            ],
            [
                'id' => 25,
                'name' => 'Dominica',
                'code' => 'DM',
                'dial_code' => '+1767',
                'currency_name' => 'East Caribbean dolla',
                'currency_symbol' => '$',
                'currency_code' => 'XCD'
            ],
            [
                'id' => 26,
                'name' => 'Ecuador',
                'code' => 'EC',
                'dial_code' => '+593',
                'currency_name' => 'United States dollar',
                'currency_symbol' => '$',
                'currency_code' => 'USD'
            ],
            [
                'id' => 27,
                'name' => 'Egypt',
                'code' => 'EG',
                'dial_code' => '+20',
                'currency_name' => 'Egyptian pound',
                'currency_symbol' => '£ orج.م ',
                'currency_code' => 'EGP'
            ],
            [
                'id' => 28,
                'name' => 'Ethiopia',
                'code' => 'ET',
                'dial_code' => '+251',
                'currency_name' => 'Ethiopian birr',
                'currency_symbol' => 'Br',
                'currency_code' => 'ETB'
            ],
            [
                'id' => 29,
                'name' => 'Fiji',
                'code' => 'FJ',
                'dial_code' => '+679',
                'currency_name' => 'Fijian dollar',
                'currency_symbol' => '$',
                'currency_code' => 'FJD'
            ],
            [
                'id' => 30,
                'name' => 'Finland',
                'code' => 'FI',
                'dial_code' => '+358',
                'currency_name' => 'Euro',
                'currency_symbol' => '€',
                'currency_code' => 'EUR'
            ],
            [
                'id' => 31,
                'name' => 'France',
                'code' => 'FR',
                'dial_code' => '+33',
                'currency_name' => 'Euro',
                'currency_symbol' => '€',
                'currency_code' => 'EUR'
            ],
            [
                'id' => 32,
                'name' => 'Georgia',
                'code' => 'GE',
                'dial_code' => '+995',
                'currency_name' => 'Georgian lari',
                'currency_symbol' => 'ლ',
                'currency_code' => 'GEL'
            ],
            [
                'id' => 33,
                'name' => 'Germany',
                'code' => 'DE',
                'dial_code' => '+49',
                'currency_name' => 'Euro',
                'currency_symbol' => '€',
                'currency_code' => 'EUR'
            ],
            [
                'id' => 34,
                'name' => 'Ghana',
                'code' => 'GH',
                'dial_code' => '+233',
                'currency_name' => 'Ghana cedi',
                'currency_symbol' => '₵',
                'currency_code' => 'GHS'
            ],
            [
                'id' => 35,
                'name' => 'Greece',
                'code' => 'GR',
                'dial_code' => '+30',
                'currency_name' => 'Euro',
                'currency_symbol' => '€',
                'currency_code' => 'EUR'
            ],
            [
                'id' => 36,
                'name' => 'Haiti',
                'code' => 'HT',
                'dial_code' => '+509',
                'currency_name' => 'Haitian gourde',
                'currency_symbol' => 'G',
                'currency_code' => 'HTG'
            ],
            [
                'id' => 37,
                'name' => 'Hong Kong',
                'code' => 'HK',
                'dial_code' => '+852',
                'currency_name' => 'Hong Kong dollar',
                'currency_symbol' => '$',
                'currency_code' => 'HKD'
            ],
            [
                'id' => 38,
                'name' => 'Hungary',
                'code' => 'HU',
                'dial_code' => '+36',
                'currency_name' => 'Hungarian forint',
                'currency_symbol' => 'Ft',
                'currency_code' => 'HUF'
            ],
            [
                'id' => 39,
                'name' => 'Iceland',
                'code' => 'IS',
                'dial_code' => '+354',
                'currency_name' => 'Icelandic króna',
                'currency_symbol' => 'kr',
                'currency_code' => 'ISK'
            ],
            [
                'id' => 40,
                'name' => 'India',
                'code' => 'IN',
                'dial_code' => '+91',
                'currency_name' => 'Indian rupee',
                'currency_symbol' => '₹',
                'currency_code' => 'INR'
            ],
            [
                'id' => 41,
                'name' => 'Indonesia',
                'code' => 'ID',
                'dial_code' => '+62',
                'currency_name' => 'Indonesian rupiah',
                'currency_symbol' => 'Rp',
                'currency_code' => 'IDR'
            ],
            [
                'id' => 42,
                'name' => 'Iraq',
                'code' => 'IQ',
                'dial_code' => '+964',
                'currency_name' => 'Iraqi dinar',
                'currency_symbol' => 'ع.د',
                'currency_code' => 'IQD'
            ],
            [
                'id' => 43,
                'name' => 'Ireland',
                'code' => 'IE',
                'dial_code' => '+353',
                'currency_name' => 'Euro',
                'currency_symbol' => '€',
                'currency_code' => 'EUR'
            ],
            [
                'id' => 44,
                'name' => 'Israel',
                'code' => 'IL',
                'dial_code' => '+972',
                'currency_name' => 'Israeli new shekel',
                'currency_symbol' => '₪',
                'currency_code' => 'ILS'
            ],
            [
                'id' => 45,
                'name' => 'Italy',
                'code' => 'IT',
                'dial_code' => '+39',
                'currency_name' => 'Euro',
                'currency_symbol' => '€',
                'currency_code' => 'EUR'
            ],
            [
                'id' => 46,
                'name' => 'Jamaica',
                'code' => 'JM',
                'dial_code' => '+1876',
                'currency_name' => 'Jamaican dollar',
                'currency_symbol' => '$',
                'currency_code' => 'JMD'
            ],
            [
                'id' => 47,
                'name' => 'Japan',
                'code' => 'JP',
                'dial_code' => '+81',
                'currency_name' => 'Japanese yen',
                'currency_symbol' => '¥',
                'currency_code' => 'JPY'
            ],
            [
                'id' => 48,
                'name' => 'Jersey',
                'code' => 'JE',
                'dial_code' => '+44',
                'currency_name' => 'British pound',
                'currency_symbol' => '£',
                'currency_code' => 'GBP'
            ],
            [
                'id' => 49,
                'name' => 'Jordan',
                'code' => 'JO',
                'dial_code' => '+962',
                'currency_name' => 'Jordanian dinar',
                'currency_symbol' => 'د.ا',
                'currency_code' => 'JOD'
            ],
            [
                'id' => 50,
                'name' => 'Kenya',
                'code' => 'KE',
                'dial_code' => '+254',
                'currency_name' => 'Kenyan shilling',
                'currency_symbol' => 'Sh',
                'currency_code' => 'KES'
            ],
            [
                'id' => 51,
                'name' => 'Kuwait',
                'code' => 'KW',
                'dial_code' => '+965',
                'currency_name' => 'Kuwaiti dinar',
                'currency_symbol' => 'د.ك',
                'currency_code' => 'KWD'
            ],
            [
                'id' => 52,
                'name' => 'Kyrgyzstan',
                'code' => 'KG',
                'dial_code' => '+996',
                'currency_name' => 'Kyrgyzstani som',
                'currency_symbol' => 'лв',
                'currency_code' => 'KGS'
            ],
            [
                'id' => 53,
                'name' => 'Lebanon',
                'code' => 'LB',
                'dial_code' => '+961',
                'currency_name' => 'Lebanese pound',
                'currency_symbol' => 'ل.ل.‎',
                'currency_code' => 'LBP'
            ],
            [
                'id' => 54,
                'name' => 'Liberia',
                'code' => 'LR',
                'dial_code' => '+231',
                'currency_name' => 'Liberian dollar',
                'currency_symbol' => '$',
                'currency_code' => 'LRD'
            ],
            [
                'id' => 55,
                'name' => 'Liechtenstein',
                'code' => 'LI',
                'dial_code' => '+423',
                'currency_name' => 'Swiss franc',
                'currency_symbol' => 'Fr',
                'currency_code' => 'CHF'
            ],
            [
                'id' => 56,
                'name' => 'Lithuania',
                'code' => 'LT',
                'dial_code' => '+370',
                'currency_name' => 'Euro',
                'currency_symbol' => '€',
                'currency_code' => 'EUR'
            ],
            [
                'id' => 57,
                'name' => 'Madagascar',
                'code' => 'MG',
                'dial_code' => '+261',
                'currency_name' => 'Malagasy ariary',
                'currency_symbol' => 'Ar',
                'currency_code' => 'MGA'
            ],
            [
                'id' => 58,
                'name' => 'Malaysia',
                'code' => 'MY',
                'dial_code' => '+60',
                'currency_name' => 'Malaysian ringgit',
                'currency_symbol' => 'RM',
                'currency_code' => 'MYR'
            ],
            [
                'id' => 59,
                'name' => 'Malaysia',
                'code' => 'MY',
                'dial_code' => '+60',
                'currency_name' => 'Malaysian ringgit',
                'currency_symbol' => 'RM',
                'currency_code' => 'MYR'
            ],
            [
                'id' => 60,
                'name' => 'Mauritius',
                'code' => 'MU',
                'dial_code' => '+230',
                'currency_name' => 'Mauritian rupee',
                'currency_symbol' => '₨',
                'currency_code' => 'MUR'
            ],
            [
                'id' => 61,
                'name' => 'Mexico',
                'code' => 'MX',
                'dial_code' => '+52',
                'currency_name' => 'Mexican peso',
                'currency_symbol' => '$',
                'currency_code' => 'MXN'
            ],
            [
                'id' => 62,
                'name' => 'Monaco',
                'code' => 'MC',
                'dial_code' => '+377',
                'currency_name' => 'Euro',
                'currency_symbol' => '€',
                'currency_code' => 'EUR'
            ],
            [
                'id' => 63,
                'name' => 'Mongolia',
                'code' => 'MN',
                'dial_code' => '+976',
                'currency_name' => 'Mongolian tögrög',
                'currency_symbol' => '₮',
                'currency_code' => 'MNT'
            ],
            [
                'id' => 64,
                'name' => 'Morocco',
                'code' => 'MA',
                'dial_code' => '+212',
                'currency_name' => 'Moroccan dirham',
                'currency_symbol' => 'د.م.',
                'currency_code' => 'MAD'
            ],
            [
                'id' => 65,
                'name' => 'Myanmar',
                'code' => 'MM',
                'dial_code' => '+95',
                'currency_name' => 'Burmese kyat',
                'currency_symbol' => 'Ks',
                'currency_code' => 'MMK'
            ],
            [
                'id' => 66,
                'name' => 'Nepal',
                'code' => 'NP',
                'dial_code' => '+977',
                'currency_name' => 'Nepalese rupee',
                'currency_symbol' => '₨',
                'currency_code' => 'NPR'
            ],
            [
                'id' => 67,
                'name' => 'Netherlands',
                'code' => 'NL',
                'dial_code' => '+31',
                'currency_name' => 'Euro',
                'currency_symbol' => '€',
                'currency_code' => 'EUR'
            ],
            [
                'id' => 68,
                'name' => 'New Zealand',
                'code' => 'NZ',
                'dial_code' => '+64',
                'currency_name' => 'New Zealand dollar',
                'currency_symbol' => '$',
                'currency_code' => 'NZD'
            ],
            [
                'id' => 69,
                'name' => 'Nigeria',
                'code' => 'NG',
                'dial_code' => '+234',
                'currency_name' => 'Nigerian naira',
                'currency_symbol' => '₦',
                'currency_code' => 'NGN'
            ],
            [
                'id' => 70,
                'name' => 'Norway',
                'code' => 'NO',
                'dial_code' => '+47',
                'currency_name' => 'Norwegian krone',
                'currency_symbol' => 'kr',
                'currency_code' => 'NOK'
            ],
            [
                'id' => 71,
                'name' => 'Oman',
                'code' => 'OM',
                'dial_code' => '+968',
                'currency_name' => 'Omani rial',
                'currency_symbol' => 'ر.ع.',
                'currency_code' => 'OMR'
            ],
            [
                'id' => 72,
                'name' => 'Pakistan',
                'code' => 'PK',
                'dial_code' => '+92',
                'currency_name' => 'Pakistani rupee',
                'currency_symbol' => '₨',
                'currency_code' => 'PKR'
            ],
            [
                'id' => 73,
                'name' => 'Panama',
                'code' => 'PA',
                'dial_code' => '+507',
                'currency_name' => 'Panamanian balboa',
                'currency_symbol' => 'B/.',
                'currency_code' => 'PAB'
            ],
            [
                'id' => 74,
                'name' => 'Paraguay',
                'code' => 'PY',
                'dial_code' => '+595',
                'currency_name' => 'Paraguayan guaraní',
                'currency_symbol' => '₲',
                'currency_code' => 'PYG'
            ],
            [
                'id' => 75,
                'name' => 'Peru',
                'code' => 'PE',
                'dial_code' => '+51',
                'currency_name' => 'Peruvian nuevo sol',
                'currency_symbol' => 'S/.',
                'currency_code' => 'PEN'
            ],
            [
                'id' => 76,
                'name' => 'Philippines',
                'code' => 'PH',
                'dial_code' => '+63',
                'currency_name' => 'Philippine peso',
                'currency_symbol' => '₱',
                'currency_code' => 'PHP'
            ],
            [
                'id' => 77,
                'name' => 'Poland',
                'code' => 'PL',
                'dial_code' => '+48',
                'currency_name' => 'Polish z?oty',
                'currency_symbol' => 'zł',
                'currency_code' => 'PLN'
            ],
            [
                'id' => 78,
                'name' => 'Portugal',
                'code' => 'PT',
                'dial_code' => '+351',
                'currency_name' => 'Euro',
                'currency_symbol' => '€',
                'currency_code' => 'EUR'
            ],
            [
                'id' => 79,
                'name' => 'Qatar',
                'code' => 'QA',
                'dial_code' => '+974',
                'currency_name' => 'Qatari riyal',
                'currency_symbol' => 'ر.ق',
                'currency_code' => 'QAR'
            ],
            [
                'id' => 80,
                'name' => 'Romania',
                'code' => 'RO',
                'dial_code' => '+40',
                'currency_name' => 'Romanian leu',
                'currency_symbol' => 'lei',
                'currency_code' => 'RON'
            ],
            [
                'id' => 81,
                'name' => 'Russia',
                'code' => 'RU',
                'dial_code' => '+7',
                'currency_name' => 'Russian ruble',
                'currency_symbol' => '₽',
                'currency_code' => 'RUB'
            ],
            [
                'id' => 82,
                'name' => 'Saudi Arabia',
                'code' => 'SA',
                'dial_code' => '+966',
                'currency_name' => 'Saudi riyal',
                'currency_symbol' => ' ر.س',
                'currency_code' => 'SAR'
            ],
            [
                'id' => 83,
                'name' => 'Senegal',
                'code' => 'SN',
                'dial_code' => '+221',
                'currency_name' => 'West African CFA fra',
                'currency_symbol' => 'Fr',
                'currency_code' => 'XOF'
            ],
            [
                'id' => 84,
                'name' => 'Singapore',
                'code' => 'SG',
                'dial_code' => '+65',
                'currency_name' => 'Brunei dollar',
                'currency_symbol' => '$',
                'currency_code' => 'BND'
            ],
            [
                'id' => 85,
                'name' => 'Slovakia',
                'code' => 'SK',
                'dial_code' => '+421',
                'currency_name' => 'Euro',
                'currency_symbol' => '€',
                'currency_code' => 'EUR'
            ],
            [
                'id' => 86,
                'name' => 'Somalia',
                'code' => 'SO',
                'dial_code' => '+252',
                'currency_name' => 'Somali shilling',
                'currency_symbol' => 'Sh',
                'currency_code' => 'SOS'
            ],
            [
                'id' => 87,
                'name' => 'South Africa',
                'code' => 'ZA',
                'dial_code' => '+27',
                'currency_name' => 'South African rand',
                'currency_symbol' => 'R',
                'currency_code' => 'ZAR'
            ],
            [
                'id' => 88,
                'name' => 'Spain',
                'code' => 'ES',
                'dial_code' => '+34',
                'currency_name' => 'Euro',
                'currency_symbol' => '€',
                'currency_code' => 'EUR'
            ],
            [
                'id' => 89,
                'name' => 'Sri Lanka',
                'code' => 'LK',
                'dial_code' => '+94',
                'currency_name' => 'Sri Lankan rupee',
                'currency_symbol' => 'Rs or රු',
                'currency_code' => 'LKR'
            ],
            [
                'id' => 90,
                'name' => 'Sudan',
                'code' => 'SD',
                'dial_code' => '+249',
                'currency_name' => 'Sudanese pound',
                'currency_symbol' => 'SD',
                'currency_code' => 'SDG'
            ],
            [
                'id' => 91,
                'name' => 'Swaziland',
                'code' => 'SZ',
                'dial_code' => '+268',
                'currency_name' => 'Swazi lilangeni',
                'currency_symbol' => 'L',
                'currency_code' => 'SZL'
            ],
            [
                'id' => 92,
                'name' => 'Sweden',
                'code' => 'SE',
                'dial_code' => '+46',
                'currency_name' => 'Swedish krona',
                'currency_symbol' => 'kr',
                'currency_code' => 'SEK'
            ],
            [
                'id' => 93,
                'name' => 'Switzerland',
                'code' => 'CH',
                'dial_code' => '+41',
                'currency_name' => 'Swiss franc',
                'currency_symbol' => 'Fr',
                'currency_code' => 'CHF'
            ],
            [
                'id' => 94,
                'name' => 'Taiwan',
                'code' => 'TW',
                'dial_code' => '+886',
                'currency_name' => 'New Taiwan dollar',
                'currency_symbol' => '$',
                'currency_code' => 'TWD'
            ],
            [
                'id' => 95,
                'name' => 'Thailand',
                'code' => 'TH',
                'dial_code' => '+66',
                'currency_name' => 'Thai baht',
                'currency_symbol' => '฿',
                'currency_code' => 'THB'
            ],
            [
                'id' => 96,
                'name' => 'Uganda',
                'code' => 'UG',
                'dial_code' => '+256',
                'currency_name' => 'Ugandan shilling',
                'currency_symbol' => 'Sh',
                'currency_code' => 'UGX'
            ],
            [
                'id' => 97,
                'name' => 'Ukraine',
                'code' => 'UA',
                'dial_code' => '+380',
                'currency_name' => 'Ukrainian hryvnia',
                'currency_symbol' => '₴',
                'currency_code' => 'UAH'
            ],
            [
                'id' => 98,
                'name' => 'United Arab Emirates',
                'code' => 'AE',
                'dial_code' => '+971',
                'currency_name' => 'United Arab Emirates',
                'currency_symbol' => 'AE',
                'currency_code' => 'AED'
            ],
            [
                'id' => 99,
                'name' => 'United Kingdom',
                'code' => 'GB',
                'dial_code' => '+44',
                'currency_name' => 'British pound',
                'currency_symbol' => '£',
                'currency_code' => 'GBP'
            ],
            [
                'id' => 100,
                'name' => 'United States',
                'code' => 'US',
                'dial_code' => '+1',
                'currency_name' => 'United States dollar',
                'currency_symbol' => '$',
                'currency_code' => 'USD'
            ],
            [
                'id' => 101,
                'name' => 'Uruguay',
                'code' => 'UY',
                'dial_code' => '+598',
                'currency_name' => 'Uruguayan peso',
                'currency_symbol' => '$',
                'currency_code' => 'UYU'
            ],
            [
                'id' => 102,
                'name' => 'Vietnam',
                'code' => 'VN',
                'dial_code' => '+84',
                'currency_name' => 'Vietnamese ??ng',
                'currency_symbol' => '₫',
                'currency_code' => 'VND'
            ],
            [
                'id' => 103,
                'name' => 'Yemen',
                'code' => 'YE',
                'dial_code' => '+967',
                'currency_name' => 'Yemeni rial',
                'currency_symbol' => '﷼',
                'currency_code' => 'YER'
            ],
            [
                'id' => 104,
                'name' => 'Zimbabwe',
                'code' => 'ZW',
                'dial_code' => '+263',
                'currency_name' => 'Botswana pula',
                'currency_symbol' => 'P',
                'currency_code' => 'BWP'
            ]
        ]);
    }
}
