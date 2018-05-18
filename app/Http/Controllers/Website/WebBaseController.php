<?php

namespace SenseBook\Http\Controllers\Website;

use SenseBook\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App;

class WebBaseController extends Controller
{
    protected $data;

    public function __construct(Request $request, $lang = 'en')
    {
        if ($request->get('lang')) {
            $_l = $request->get('lang');
            $this->setLang($_l);
        } else {
            if (!Session::has('language')) {
                $_default_lang = env('APP_DEFAULT_LANG', 'en');
                $this->setLang($_default_lang);
            } else {
                $_app_language = Session::get('language');
                $this->setLang($_app_language);
            }
        }

        $this->data['language'] = Session::get('language');
        $this->data['root_url'] = str_replace('/index.php', '', $request->root());
        
        $this->data['current_path'] = $request->path();
    }


    public function setLang($lang = 'en')
    {
        if (isset($lang) || !empty($lang)) {
            Session::forget('language');
            App::setLocale($lang);

            $language = $this->getLang();
            Session::put('language', $language);
        } else {
            $l = 'en';
            $this->setLang($l);
        }
    }

    public function getLang()
    {
        if (Session::has('language')) {
            return Session::get('language');
        } else {
            return App::getLocale();
        }
    }
}
