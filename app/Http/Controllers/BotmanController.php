<?php

namespace App\Http\Controllers;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;

use Illuminate\Http\Request;

class BotmanController extends Controller
{
    public function handle()
    {
        DriverManager::loadDriver(\BotMan\Drivers\Web\WebDriver::class);
        $config = [];

        $botman = BotManFactory::create($config);

        $botman->hears('hello', function (BotMan $bot) {
            $bot->reply('Hello yourself.');
        });
        

        $botman->hears('start conversation', function (BotMan $bot) {
            $this->startConversation($bot);
        });
        $botman->hears('.*giá vé.*', function (BotMan $bot) {
            $bot->reply('Giá vé có thể thay đổi theo từng rạp và suất chiếu. Vui lòng kiểm tra trực tuyến hoặc liên hệ với rạp để biết thông tin chi tiết.');
        });
        $botman->hears('.*.*', function (BotMan $bot) {
            // Thực hiện logic để trả lời câu hỏi về giá vé
            $bot->reply('');
        });

        $botman->listen();
    }

    public function startConversation(BotMan $bot)
    {
        $question = Question::create('Do you want to continue?')
            ->fallback('Unable to ask question')
            ->callbackId('ask_reason')
            ->addButtons([
                Button::create('Yes')->value('yes'),
                Button::create('No')->value('no'),
            ]);

        $bot->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                if ($answer->getValue() === 'yes') {
                    $this->say('Great! Let\'s continue...');
                } else {
                    $this->say('Okay, maybe next time.');
                }
            }
        });
    }
    public function chat()
    {
        return view('web.pages.home');
    }
}
