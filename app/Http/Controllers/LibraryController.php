<?php

namespace App\Http\Controllers;

use App\Library;
use App\Books;
use DB;
use Flash;
use App\LibraryMember;
use App\Issue_Book;
use \Carbon\Carbon;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Library  $library
     * @return \Illuminate\Http\Response
     */
    public function show(Library $library)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Library  $library
     * @return \Illuminate\Http\Response
     */
    public function edit(Library $library)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Library  $library
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Library $library)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Library  $library
     * @return \Illuminate\Http\Response
     */
    public function destroy(Library $library)
    {
        //
    }

    public function getBooks(Request $request)
    {
        $book_list = Books::where('school_id', auth()->user()->school_id)->get();
        // $add_book = Books::where('school_id', auth()->user()->school_id)->get();
        return view('library.books.index')->with('book_list', $book_list);
    }

    public function addBooks(Request $request)
    {
        $add_book = Books::where('school_id', auth()->user()->school_id)->get();
        return view('library.books.index')->with('add_book', $add_book);
    }

    

    public function saveBooks(Request $request)
    {
        $save_book = new Books;

        $save_book->book_title = $request->book_title;
        $save_book->book_number = $request->book_number;
        $save_book->isbn_number = $request->isbn_number;
        $save_book->publish = $request->publisher;
        $save_book->author = $request->author;
        $save_book->subject = $request->subject;
        $save_book->rac_number = $request->rac_number;
        $save_book->book_qty = $request->book_qty;
        $save_book->book_price = $request->book_price;
        $save_book->post_date = $request->post_date;
        $save_book->description = $request->description;
        $save_book->school_id = $request->school_id;
        $save_book->user_id = auth()->user()->id;

        $save_book->save();

        Flash::success('Book Saved Successfully');
        return redirect(route('book.index'));
    }

    public function editBooks(Books $book,  $book_id)
    {
        $book = Books::find($book_id);
        $book_update = Books::find($book_id);
        $add_book = Books::where('school_id', auth()->user()->school_id)->get();
        return view('library.books.index')->with('book', $book)->with('add_book', $add_book)->with('book_update', $book_update);
    }

    public function updateBooks(Request $request, $book_id)
    {
        $save_book = array(

        'book_title' => $request->book_title,
        'book_number' => $request->book_number,
        'isbn_number' => $request->isbn_number,
        'publish' => $request->publisher,
        'author' => $request->author,
        'subject' => $request->subject,
        'rac_number' => $request->rac_number,
        'book_qty' => $request->book_qty,
        'book_price' => $request->book_price,
        'post_date' => $request->post_date,
        'description' => $request->description,
        'school_id' => $request->school_id,
        'user_id' => auth()->user()->id,
        );

        Books::findOrfail($book_id)->update($save_book);
      
        Flash::success('Book Updated Successfully');
        return redirect(route('book.index'));
        // return view('library.books.index');
    }

    public function getBooksDetail(Request $request)
    {
        
        return view('library.books.index');
    }

    public function deleteBooks(Request $request)
    {
        
        return view('library.books.index');
    }

    public function getLibraryMember(Request $request)
    {
        $member_list = LibraryMember::join('rolls', 'rolls.username', '=', 'library_members.roll_no')
        ->join('admissions', 'admissions.id', '=', 'rolls.student_id')
        ->select('library_members.*', 'admissions.first_name', 'admissions.last_name','admissions.image','admissions.phone')
        ->where('library_members.school_id', auth()->user()->school_id)->get();

        
        // $add_book = Books::where('school_id', auth()->user()->school_id)->get();
        return view('library.members.index')->with('member_list', $member_list);
    }

    public function addLibraryMember(Request $request)
    {
        $add_member = LibraryMember::where('school_id', auth()->user()->school_id)->get();

        $id = LibraryMember::max('id');

        if(count($add_member)!=0){
            $library_card_number = mt_rand(10000 .$id +1,  10000 .$id +1);
        }

        // dd($library_card_number);
        return view('library.members.index', compact('library_card_number'))->with('add_member', $add_member);
    }
    
    public function saveLibraryMember(Request $request)
    {

        $check_member = LibraryMember::where(['roll_no' => $request->roll_no])->count();
        // dd( $check_member);
        if ($check_member > 0) {
               
                Flash::error('Member already Exist, please try another member');
                return back();
        }

        $library_member = new LibraryMember;

        $library_member->roll_no = $request->roll_no;
        $library_member->library_card = $request->library_card;
        $library_member->join_date = $request->join_date;
        $library_member->member_type = $request->member_type;
        $library_member->status = $request->status;
        $library_member->school_id = $request->school_id;
        $library_member->user_id = auth()->user()->id;
        $library_member->save();

        Flash::success('Member Registered Successfully');
        return redirect(route('librarymember.index'));
    }

    public function editLibraryMember(Books $book,  $book_id)
    {
        $member = LibraryMember::find($book_id);
        $book_update = LibraryMember::find($book_id);
        $add_member = Books::where('school_id', auth()->user()->school_id)->get();
        return view('library.members.index')->with('member', $member)->with('add_member', $add_member)->with('book_update', $book_update);
    }

    public function updateLibraryMember(Request $request, $book_id)
    {
        $save_book = array(

        'book_title' => $request->book_title,
        'book_number' => $request->book_number,
        'isbn_number' => $request->isbn_number,
        'publish' => $request->publisher,
        'author' => $request->author,
        'subject' => $request->subject,
        'rac_number' => $request->rac_number,
        'book_qty' => $request->book_qty,
        'book_price' => $request->book_price,
        'post_date' => $request->post_date,
        'description' => $request->description,
        'school_id' => $request->school_id,
        'user_id' => auth()->user()->id,
        );

        Books::findOrfail($book_id)->update($save_book);
      
        Flash::success('Book Updated Successfully');
        return redirect(route('book.index'));
        // return view('library.books.index');
    }

    public function getLibraryMemberDetail(Request $request)
    {
        
        return view('library.books.index');
    }

    public function deleteLibraryMember(Request $request)
    {
        
        return view('library.books.index');
    }

    public function getIssueBookDetail(Request $request, $roll_no)
    {
        $issue_book = LibraryMember::join('rolls', 'rolls.username', '=', 'library_members.roll_no')
        ->join('admissions', 'admissions.id', '=', 'rolls.student_id')
        ->join('issue_book', 'issue_book.student_id', '=', 'rolls.student_id')
        ->select('library_members.*', 'admissions.first_name', 'admissions.last_name','admissions.gender',
        'admissions.image','admissions.phone', 'admissions.id as student_id','issue_book.return_date')
        ->where('library_members.school_id', auth()->user()->school_id)
        ->where('library_members.roll_no', $roll_no)
        ->first();

        $issue_list = DB::table('issue_book')->join('admissions', 'admissions.id', '=', 'issue_book.student_id')
        ->join('books', 'books.id', '=', 'issue_book.book_id')
        ->join('rolls', 'rolls.student_id', '=', 'admissions.id')
        ->select('issue_book.id as issue_book_id', 'issue_book.due_return_date',
         'issue_book.return_date','issue_book.issue_date', 
        'admissions.first_name', 'admissions.last_name','admissions.gender',
        'books.book_title', 'books.book_number','rolls.username','admissions.email',
        'admissions.image','admissions.phone', 'admissions.id as student_id')
        ->where('issue_book.school_id', auth()->user()->school_id)
        ->where('rolls.username', $roll_no)
        ->get();

        $issue_list1 = DB::table('issue_book')->join('admissions', 'admissions.id', '=', 'issue_book.student_id')
        ->join('books', 'books.id', '=', 'issue_book.book_id')
        ->join('rolls', 'rolls.student_id', '=', 'admissions.id')
        ->select('issue_book.id as issue_book_id', 'issue_book.due_return_date',
         'issue_book.return_date','issue_book.issue_date', 
        'admissions.first_name', 'admissions.last_name',
        'books.book_title', 'books.book_number','rolls.username',
        'admissions.image','admissions.phone', 'admissions.id as student_id')
        ->where('issue_book.school_id', auth()->user()->school_id)
        ->where('rolls.username', $roll_no)
        // ->whereDate('return_date', '>', $issue_book->return_date)
        ->get();

        // $allDeliveries = $issue_list1->whereDate('return_date', '>', now()->addDays(5))->count();

        $now = date('Y-m-d');
        $new_value = '';
        
            // $start_date = \Carbon\Carbon::createFromFormat('Y-m-d', $value->due_return_date);
            // $end_date = \Carbon\Carbon::createFromFormat('Y-m-d',  $value->return_date);
            // // $end_date =  $issue_list1->due_return_date;
            // $new_value =  $different_days = $start_date->diffInDays($end_date);
        
      
        // dd( $new_value);

        $book_issue_return = Issue_Book::find($roll_no);

        return view('library.members.index', compact('book_issue_return'))->with('issue_book', $issue_book)->with('issue_list', $issue_list);
    }

    public function saveIssueBook(Request $request)
    {
        // dd($request->all());
        $save_issue_book = new Issue_Book;

        $save_issue_book->issue_date = $request->issue_date;
        $save_issue_book->due_return_date = $request->due_return_date;
        $save_issue_book->book_id = $request->book_id;
        $save_issue_book->student_id = $request->student_id;
        $save_issue_book->school_id = $request->school_id;
        $save_issue_book->user_id = auth()->user()->id;

        $save_issue_book->save();
        Flash::success('Book Issued Successfully!');
        return back();
    }

    public function editIssueBook(Issue_Book $book,  $book_id)
    {
        $book_issue_return = Issue_Book::find($book_id);

        $issue_book = LibraryMember::join('rolls', 'rolls.username', '=', 'library_members.roll_no')
        ->join('admissions', 'admissions.id', '=', 'rolls.student_id')
        ->select('library_members.*', 'admissions.first_name', 'admissions.last_name','admissions.gender',
        'admissions.image','admissions.phone', 'admissions.id as student_id','library_members.roll_no')
        ->where('library_members.school_id', auth()->user()->school_id)
        ->where('admissions.id', $book_issue_return->student_id)
        ->first();

        $issue_list = DB::table('issue_book')->join('admissions', 'admissions.id', '=', 'issue_book.student_id')
        ->join('books', 'books.id', '=', 'issue_book.book_id')
        ->select('issue_book.id as issue_book_id', 'issue_book.due_return_date',
         'issue_book.return_date','issue_book.issue_date', 
        'admissions.first_name', 'admissions.last_name',
        'books.book_title', 'books.book_number','admissions.gender','admissions.email',
        'admissions.image','admissions.phone', 'admissions.id as student_id')
        ->where('issue_book.student_id', $book_issue_return->student_id)
        ->where('issue_book.school_id', auth()->user()->school_id)->get();
        // $book_update = Issue_Book::find($book_id);

        // $add_member = Books::where('school_id', auth()->user()->school_id)->get();
        return view('library.members.index')->with('book_issue_return', $book_issue_return)
        ->with('issue_book', $issue_book)->with('issue_list', $issue_list);
    }


    public function updateIssueBook(Request $request, $book_id)
    {
        // dd($request->all());
        $save_book = array(

        'return_date' => $request->return_date,
        'school_id' => $request->school_id,
        'user_id' => auth()->user()->id,
        );

        Issue_Book::findOrfail($book_id)->update($save_book);
      
        Flash::success('Book Returned Successfully');
        return back();
        // return view('library.books.index');
    }

   
    
}
