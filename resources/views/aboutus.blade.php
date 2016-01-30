@extends('layouts.master-no-sidebar')

@section('title', 'About Us')

@section('internal-css')
    @parent

    .wrapper{
        padding-top: 20px;
    }
    .wrapper h4{
        padding-top: 1px;
        padding-bottom: 1px;
        text-align: center;
        background: #3B8EE3;
        color: white;
    }
    .wrapper p{
        padding-top: 10px;
        text-align: center;
    }
    
    #TimKami {
        text-align: center;
    }
@endsection

@section('content')
    <mark><h4>TENTANG CUAP CUAP CAPUNG</h4></mark>
    <p>Cuap Cuap Capung adalah sebuah website yang dibuat sebagai sarana 
    untuk mahasiswa angkatan 2015 saling berkomunikasi. <br />
    Website ini dibuat 
    dengan tujuan mempermudah komunikasi dan mempererat hubungan angkatan 2015.</p>
    <div id="TimKami">
    <h4>TIM KAMI</h5>
        <div class="row">
            <div class="col-4">
                <img src="collaborators/img/Aldi.PNG" style="width: 60%;"></img><br>
                <strong>Aldi Fahrezi</strong><br>
                Project Officer
            </div>
            <div class="col-4">
                <img src="collaborators/img/Arief.PNG" style="width: 60%;"></img><br>
                <strong>Arief Tritomo</strong><br>
                Back-end Team
            </div>
            <div class="col-4">
                <img src="collaborators/img/Avicenna.PNG" style="width: 60%;"></img><br>
                <strong>Avicenna Wisesa</strong><br>
                Back-end Team
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <img src="collaborators/img/Fahmi.PNG" style="width: 60%;"></img><br>
                <strong>Fahmi</strong><br>
                Back-end Team
            </div>
            <div class="col-4">
                <img src="collaborators/img/Hafizh.PNG" style="width: 60%;"></img><br>
                <strong>Hafizh Rafizal Adnan</strong><br>
                Front-end Team
            </div>
            <div class="col-4">
                <img src="collaborators/img/Hafizha.PNG" style="width: 60%;"></img><br>
                <strong>Hafizha Zuharah</strong><br>
                Front-end Team
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <img src="collaborators/img/Kenny.PNG" style="width: 60%;"></img><br>
                <strong>Kenny R. Dharmawan</strong><br>
                Front-end Team
            </div>
            <div class="col-4">
                <img src="collaborators/img/Aufa.PNG" style="width: 60%;"></img><br>
                <strong>Muhammad Aufa Husen</strong><br>
                Back-end Team
            </div>
            <div class="col-4">
                <img src="collaborators/img/Umar.PNG" style="width: 60%;"></img><br>
                <strong>Muhammad Umar Farisi</strong><br>
                Back-end Team
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <img src="collaborators/img/Intan.PNG" style="width: 60%;"></img><br>
                <strong>Nur Intan Alatas</strong><br>
                Front-end Team
            </div>
            <div class="col-4">
                <img src="collaborators/img/Rakha.PNG" style="width: 60%;"></img><br>
                <strong>Rakha Kanz Kautsar</strong><br>
                Front-end Team
            </div>
            <div class="col-4">
                <img src="collaborators/img/Sarah.PNG" style="width: 60%;"></img><br>
                <strong>Sarah Dewi</strong><br>
                Front-end Team
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <img src="collaborators/img/Wibi.PNG" style="width: 60%;"></img><br>
                <strong>Wibisana Bramawidya</strong><br>
                Back-end Team
            </div>
            <div class="col-4">
                <img src="collaborators/img/Wisnu.PNG" style="width: 60%;"></img><br>
                <strong>Wisnu T. Wicaksono</strong><br>
                Back-end Team
            </div>
            <div class="col-4">
                <img src="collaborators/img/Round.PNG" style="width: 60%;"></img><br>
                <strong>Ibrahim</strong><br>
                Ketua Angkatan
            </div>
        </div>
    </div>
@endsection