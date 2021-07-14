<?php

namespace App\Consts;

class AreaConsts {

  //都道府県
  const HOKKAIDO = 0;
  const AOMORI = 1;
  const IWATE = 2;
  const MIYAGI = 3;
  const AKITA = 4;
  const YAMAGATA = 5;
  const FUKUSHIMA = 6;
  const IBARAKI = 7;
  const TOCHIGI = 8;
  const GUNMA = 9;
  const SAITAMA = 10;
  const CHIBA = 11;
  const TOKYO = 12;
  const KANAGAWA = 13;
  const NIIGATA = 14;
  const TOYAMA = 15;
  const ISHIKAWA = 16;
  const FUKUI = 17;
  const YAMANASHI = 18;
  const NAGANO = 19;
  const GIFU = 20;
  const SHIZUOKA = 21;
  const AICHI = 22;
  const MIE = 23;
  const SHIGA = 24;
  const KYOTO = 25;
  const OSAKA = 26;
  const HYOGO = 27;
  const NARA = 28;
  const WAKAYAMA = 29;
  const TOTTORI = 30;
  const SHIMANE = 31;
  const OKAYAMA = 32;
  const HIROSHIMA = 33;
  const YAMAGUCHI = 34;
  const TOKUSHIMA = 35;
  const KAGAWA = 36;
  const EHIME = 37;
  const KOCHI = 38;
  const FUKUOKA = 39;
  const SAGA = 40;
  const NAGASAKI = 41;
  const KUMAMOTO = 42;
  const OITA = 43;
  const MIYAZAKI = 44;
  const KAGOSHIMA = 45;
  const OKINAWA = 46;

  public const PREFECTURE_LIST = [
    self::HOKKAIDO  =>	'北海道',
    self::AOMORI    =>	'青森県',
    self::IWATE     =>	'岩手県',
    self::MIYAGI    =>	'宮城県',
    self::AKITA     =>	'秋田県',
    self::YAMAGATA  =>	'山形県',
    self::FUKUSHIMA =>	'福島県',
    self::IBARAKI   =>	'茨城県',
    self::TOCHIGI   =>	'栃木県',
    self::GUNMA     =>	'群馬県',
    self::SAITAMA   =>	'埼玉県',
    self::CHIBA     =>	'千葉県',
    self::TOKYO     =>	'東京都',
    self::KANAGAWA  =>	'神奈川県',
    self::NIIGATA   =>	'新潟県',
    self::TOYAMA    =>	'富山県',
    self::ISHIKAWA  =>	'石川県',
    self::FUKUI     =>	'福井県',
    self::YAMANASHI =>	'山梨県',
    self::NAGANO    =>	'長野県',
    self::GIFU      =>	'岐阜県',
    self::SHIZUOKA  =>	'静岡県',
    self::AICHI     =>	'愛知県',
    self::MIE       =>	'三重県',
    self::SHIGA     =>	'滋賀県',
    self::KYOTO     =>	'京都府',
    self::OSAKA     =>	'大阪府',
    self::HYOGO     =>	'兵庫県',
    self::NARA      =>	'奈良県',
    self::WAKAYAMA  =>	'和歌山県',
    self::TOTTORI   =>	'鳥取県',
    self::SHIMANE   =>	'島根県',
    self::OKAYAMA   =>	'岡山県',
    self::HIROSHIMA =>	'広島県',
    self::YAMAGUCHI =>	'山口県',
    self::TOKUSHIMA =>	'徳島県',
    self::KAGAWA    =>	'香川県',
    self::EHIME     =>	'愛媛県',
    self::KOCHI     =>	'高知県',
    self::FUKUOKA   =>	'福岡県',
    self::SAGA      =>	'佐賀県',
    self::NAGASAKI  =>	'長崎県',
    self::KUMAMOTO  =>	'熊本県',
    self::OITA      =>	'大分県',
    self::MIYAZAKI  =>	'宮崎県',
    self::KAGOSHIMA =>	'鹿児島県',
    self::OKINAWA   =>	'沖縄県'
  ];

  //八地方区分
  const TOHOKU  = 1;
  const KANTO   = 2;
  const CHUBU   = 3;
  const KINKI   = 4;
  const CHUGOKU = 5;
  const SHIKOKU = 6;
  const KYUSHU  = 7;

  public const AREA_LIST = [
    self::HOKKAIDO => '北海道',
    self::TOHOKU   => '東北',
    self::KANTO    => '関東',
    self::CHUBU    => '中部',
    self::KINKI    => '近畿',
    self::CHUGOKU  => '中国',
    self::SHIKOKU  => '四国',
    self::KYUSHU   => '九州沖縄'
  ];

}

?>