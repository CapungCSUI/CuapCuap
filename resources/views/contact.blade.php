@extends('layouts.master-no-sidebar')

@section('title', 'Kontak')

@section('internal-css')
    @parent

    #heading{
        padding-top: 10px;
        padding-bottom: 15px;
    }
    .wrapper h3{
        text-align: center;
        color: white;
        background: #3B8EE3;
    }
    #icon{
        font-size : 80px;   
        padding-bottom: 20px;
    }
    #linkIcon{
        color: #3e3e3e;
    }
    #fb {
        text-align: right;
    }
    #twitter {
        text-align: center;
    }
    #youtube {
        text-align: left;
    }
    #form{
        width: 500px;
    }
    #formTextArea {
        width: 500px;
        height: 200px;
    }
    #heading1 {
        padding-top: 4px;
        padding-bottom: 4px;
    }
    #heading2 {
        padding-top: 4px;
        padding-bottom: 4px;
        background: #8ADD14;
    }
    .button{
        background: none !important;
        border-radius: 4px !important;
        border: 2px solid #3B8EE3 !important;

    }
@endsection

@section('content')
    <div class="row col-left-2 col-right-2 col-8" id="heading">
        <h3 id="heading1">Hubungi Kami</h3>
    </div>
    <form class="form form-left" method="post">
      {!! csrf_field() !!}
      <div class="form_group row">
        <label for="subject" class="col-3">Subjek</label>
        <div name="col-twothirds" class="input col-9">
          <input type="text" placeholder="Judul Tulisan" id="form"/>
        </div>
      </div>
      <div class="form_group row">
        <label for="email" class="col-3">Email</label>
        <div name="email" class="col-9">
          <input type="text" placeholder="Email" id="form"/>
        </div>
      </div>
      <div class="form_group row">
        <label for="text" class="col-3">Pesan</label>
        <div name="text" class="col-9">
          <textarea name="text" id="formTextArea"></textarea>
        </div>
      </div>
      <div class="form_group row col-left-3">
        <input type="submit" role="button" class="button" />
      </div>
    </form>

    <div class="row col-left-2 col-right-2 col-8" id="heading">
        <h3 id="heading2">Ikuti Kami</h3
    </div>

    <div class="row" id="icon" >
        <div class="col-1" id="fb">
            <a href="#" id="linkIcon"><span class="fa fa-facebook-square"></span></a>
        </div>
        <div class="col-9" id="twitter">
            <a href="#" id="linkIcon"><span class="fa fa-twitter-square"></span></a>
        </div>
        <div class="col-1" id="youtube">
            <a href="#" id="linkIcon"><span class="fa fa-youtube-play"></span></a>
        </div>
    </div>
@endsection