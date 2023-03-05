<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'type',
        'log_id',
        'detail',
    ];

    public function user()
    {
        return User::find($this->user_id);
    }
    public function type()
    {
        return Type::find($this->type);
    }

    public function log_type()
    {
        return Log_type::find($this->log_id);
    }


    public static function date_time($datetime){
        // ※UNIX時間とは、UTC時刻における1970年1月1日午前0時0分0秒（UNIXエポック）からの経過秒数を計算したものです。
      // $datetimeには'2023-02-13 21:55:00'のような指定した日時の文字列が入ってくる想定です
      $unix = strtotime($datetime);
      // time関数はUNIX時刻から現在までの秒数を返します
      $now = time();
      // 現在の時刻から指定した日時のユニックスタイムを引きます。これによって現在からどれくらい時間が経っているかを取得することができます。
      $diff_sec = $now - $unix;

      if ($diff_sec < 60) {
        $time = $diff_sec;
        $unit = '秒前';
      } elseif ($diff_sec < 3600) {
        $time = $diff_sec / 60;
        $unit = '分前';
      } elseif ($diff_sec < 86400) {
        $time = $diff_sec / 3600;
        $unit = '時間前';
      } elseif ($diff_sec < 2764800) {
        $time = $diff_sec / 86400;
        $unit = '日前';
      } else {
        if (date('Y') !== date('Y', $unix)) {
          $time = date('Y年n月j日', $unix);
        } else {
          $time = date('n月j日', $unix);
        }
        return $time;
      }
      return (int)$time . $unit;

    }

}
