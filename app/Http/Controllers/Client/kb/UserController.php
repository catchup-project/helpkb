<?php namespace App\Http\Controllers\Client\kb;

use App\Http\Controllers\Controller;
use App\Http\Requests\kb\CommentRequest;
use App\Http\Requests\kb\ContactRequest;
use App\Http\Requests\kb\SearchRequest;
use App\Http\Requests\kb\ProfilePassword;
use App\Model\kb\Article;
use App\Model\kb\Category;
use App\Model\kb\Comment;
use App\Model\kb\Contact;
use App\Model\kb\Faq;
use App\Model\kb\Page;
use App\Model\kb\Relationship;
use App\Model\kb\Settings;
use Config;
// use Creativeorange\Gravatar\Gravatar;
use Illuminate\Http\Request;
use Mail;
use Auth;
use Redirect;
use Hash;
use Exception;

class UserController extends Controller
{

  public function __construct()
  {
  }

  /**
   * @param
   * @return response
   * @package default
   */
  public function getArticle(Article $article, Category $category, Settings $settings)
  {
    //$settings = $settings->first();
    $pagination = 25;
    // $article = $article->where('status', '1');
    // $article = $article->where('type', '1');
    $article = $article->paginate($pagination);
    $article->setPath('article-list');
    $categorys = $category->get();
    return view('themes.default1.client.kb.article-list.articles', compact('time', 'categorys', 'article'));
  }

  /**
   * Get excerpt from string
   *
   * @param String  $str       String to get an excerpt from
   * @param Integer $startPos  Position int string to start excerpt from
   * @param Integer $maxLength Maximum length the excerpt may be
   * @return String excerpt
   */
  static function getExcerpt($str, $startPos = 0, $maxLength = 50)
  {
    if (strlen($str) > $maxLength) {
      $excerpt = substr($str, $startPos, $maxLength - 3);
      $lastSpace = strrpos($excerpt, ' ');
      $excerpt = substr($excerpt, 0, $lastSpace);
      $excerpt .= '...';
    } else {
      $excerpt = $str;
    }

    return $excerpt;
  }

  public function search(SearchRequest $request, Category $category, Article $article, Settings $settings)
  {
    $settings = $settings->first();
    $pagination = 25;
    $search = $request->input('s');
    $result = $article->search($search)->paginate($pagination);
    $result->setPath('search');
    //dd($result);
    $categorys = $category->get();
    return view('themes.default1.client.kb.article-list.search', compact('categorys', 'result'));
  }

  /**
   * to show the seleted article
   *
   * @return response
   */
  public function show($slug, Article $article, Category $category)
  {
    $arti = $article->where('slug', $slug)->where('status', '1')->where('type', '1')->first();
    return view('themes.default1.client.kb.article-list.show', compact('arti'));
  }

  public function getCategory($slug, Article $article, Category $category, Relationship $relation)
  {
    /* get the article_id where category_id == current category */
    $catid = $category->where('slug', $slug)->first();
    $id = $catid->id;
    $all = $relation->where('category_id', $id)->get();
    // $all->setPath('');
    /* from whole attribute pick the article_id */
    $article_id = $all->lists('article_id');
    $categorys = $category->get();
    /* direct to view with $article_id */
    return view('themes.default1.client.kb.article-list.category', compact('all', 'id', 'categorys', 'article_id'));
  }

  public function home(Article $article, Category $category, Relationship $relation)
  {
    //if (Config::get('database.install') == '%0%') {
      //return redirect('step1');
    //} else {
      //$categorys = $category->get();
      $categorys = $category->get();
      // $categorys->setPath('home');
      /* direct to view with $article_id */
      return view('themes.default1.client.kb.article-list.home', compact('categorys', 'article_id'));
    //}
  }


  /**
   * get the contact page for user
   *
   * @return response
   */
  public function contact(Category $category, Settings $settings)
  {
    $settings = $settings->whereId('1')->first();
    $categorys = $category->get();
    return view('themes.default1.client.kb.article-list.contact', compact('settings', 'categorys'));
  }

  /**
   * send message to the mail adderess that define in the system
   *
   * @return response
   */
  public function postContact(ContactRequest $request, Contact $contact)
  {
    $this->port();
    $this->host();
    $this->encryption();
    $this->email();
    $this->password();
    //return Config::get('mail');
    $contact->fill($request->input())->save();
    $name = $request->input('name');
    //echo $name;
    $email = $request->input('email');
    //echo $email;
    $subject = $request->input('subject');
    //echo $subject;
    $details = $request->input('message');
    //echo $message;
    //echo $contact->email;
    $mail = Mail::send('themes.default1.client.kb.article-list.contact-details', array('name' => $name, 'email' => $email, 'subject' => $subject, 'details' => $details), function ($message) use ($contact) {
      $message->to($contact->email, $contact->name)->subject('Contact');
    });
    if ($mail) {
      return redirect('contact')->with('success', 'Your details sent to System');
    } else {
      return redirect('contact')->with('fails', 'Your details can not send to System');
    }
  }

  public function contactDetails()
  {
    return view('themes.default1.client.kb.article-list.contact-details');
  }


  public function getPage($name, Page $page)
  {
    $page = $page->where('slug', $name)->first();
    //$this->timezone($page->created_at);
    return view('themes.default1.client.kb.article-list.pages', compact('page'));
  }

  public function getCategoryList(Article $article, Category $category, Relationship $relation)
  {
    //$categorys = $category->get();
    $categorys = $category->get();
    // $categorys->setPath('home');
    /* direct to view with $article_id */
    return view('themes.default1.client.kb.article-list.categoryList', compact('categorys', 'article_id'));

  }
}
