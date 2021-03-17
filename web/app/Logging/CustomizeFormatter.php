<?php

namespace App\Logging;

use Monolog\Formatter\JsonFormatter;
use Monolog\Handler\FormattableHandlerInterface;
use Monolog\Handler\ProcessableHandlerInterface;
use Monolog\Logger;
use Monolog\Processor\IntrospectionProcessor;
use Monolog\Processor\ProcessIdProcessor;
use Monolog\Processor\UidProcessor;
use Monolog\Processor\WebProcessor;

class CustomizeFormatter
{
    /**
     * 渡されたロガーインスタンス（Monolog インスタンス）のカスタマイズ
     *
     * @param  Logger $monolog
     * @return void
     */
    public function __invoke($monolog)
    {
        // JSON 形式のフォーマッターを使用すると宣言
        $formatter = new JsonFormatter();


        $uidProcessor = new UidProcessor(); // プロセッサー単位のユニーク ID を発行する. handlers ループ外でインスタンス化しないと同じログがハンドラー毎に異なる UID を持つことになる
        // 出力先単位で foreach
        foreach ($monolog->getHandlers() as $handler) {
            if ($handler instanceof FormattableHandlerInterface) {
                // メッセージの形式が指定可能ならば JSON フォーマットを適用
                $handler->setFormatter($formatter);
            }
            if ($handler instanceof ProcessableHandlerInterface) {
                // Processor を扱えるならば各実行環境情報を持つ Processor を追加
                // コメントを書きやすいのでほぼ全てここで new
                // 同じ対象のログなのにハンドラーによってユニークIDが違うことになり惨事を招く UidProcessor のみループの外に記述
                $handler->pushProcessor(new IntrospectionProcessor(Logger::DEBUG, ['Illuminate\\'])); //  ログメッセージの発生源となった行/ファイル:クラス/関数
                $handler->pushProcessor(new WebProcessor()); // 現在のウェブリクエストの url/method とリモート IP
                $handler->pushProcessor(new ProcessIdProcessor()); // プロセスID
                $handler->pushProcessor($uidProcessor);
            }
        }
    }
}
