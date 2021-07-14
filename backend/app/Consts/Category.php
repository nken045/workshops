<?php

namespace App\Consts;

/** ワークショップカテゴリに関する定義 */
class Category {
    const UNSET = 0;   
    const SPORT = 1;
    const MUSIC = 2;
    const HANDMADE = 3;
    const BUSINESS = 4;
    const LANGUAGE = 5;
    const EXPERIENCE = 6;

    const CATEGORY_LIST_LOGICAL = [
        // スポーツ
        self::SPORT => 'sport',
        // 音楽
        self::MUSIC => 'music',
        // ハンドメイド
        self::HANDMADE =>'handmade',
        // ビジネス
        self::BUSINESS => 'business',
        // 語学
        self::LANGUAGE => 'language',
        // 体験
        self::EXPERIENCE => 'experience',
    ];

    const CATEGORY_LIST_PHYSICS = [
        // スポーツ
        self::SPORT => 'スポーツ',
        // 音楽
        self::MUSIC => '音楽',
        // ハンドメイド
        self::HANDMADE =>'ハンドメイド',
        // ビジネス
        self::BUSINESS => 'ビジネス',
        // 語学
        self::LANGUAGE => '語学',
        // 体験
        self::EXPERIENCE => '体験',
    ];

    const CATEGORY_TO_PHYSICS = [
        // スポーツ
        self::CATEGORY_LIST_LOGICAL[self::SPORT] => 'スポーツ',
        // 音楽
        self::CATEGORY_LIST_LOGICAL[self::MUSIC] => '音楽',
        // ハンドメイド
        self::CATEGORY_LIST_LOGICAL[self::HANDMADE] =>'ハンドメイド',
        // ビジネス
        self::CATEGORY_LIST_LOGICAL[self::BUSINESS] => 'ビジネス',
        // 語学
        self::CATEGORY_LIST_LOGICAL[self::LANGUAGE] => '語学',
        // 体験
        self::CATEGORY_LIST_LOGICAL[self::EXPERIENCE] => '体験',
    ];

}