@extends('layouts.ablackadabra')
@section('content')
<style>
    body{
        background-image: url(https://ablackadabra.com/wp-content/uploads/2022/12/shutterstock_1834299043.jpg);
        overflow-x: hidden;
    }
    .btn-ablack{
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 4px;
        height: 130px;
        width: 200px;
        background-color: rgb(255, 255, 255);
        margin: 30px 10px;
        transition: 0.5s ease-in;
        border: none;
        cursor: pointer;
    }
    .btn-ablack:hover,
    .btn-ablack:focus{

        background-image: linear-gradient(180deg,rgb(248, 248, 248) 0%,rgb(255, 225, 193) 100%);
        transform: scale(1.1);
        transition: 0.5s ease-out;
    }
    .icon-sv{
        content: url("{{asset('images/icons/buying-on-smartphone-svgrepo-com.svg')}}");

    }
    .exit-icon:hover{
        filter: invert(100%) sepia(0%) saturate(100000%) hue-rotate(119deg) brightness(120%) contrast(200%);
    }
    .dash-icon{
        height: 40px;
        color: #A77443;
    }
    .dash-title{
        padding: 0px 0px 0px 0px;
        color: #000000;
        font-family: "Heebo", Sans-serif;
    }
</style>
    <div class="container">
        {{-- <div class="background-image" style="background-image: url(https://ablackadabra.com/wp-content/uploads/2022/12/shutterstock_1834299043.jpg)"></div> --}}
        <div class="">
            <div class="row justify-content-center">
                <div class=" btn-ablack justify-conrent-center d-flex">
                    <div> <span><i class="fa-solid fa-house-laptop dash-icon" style="height: 40px;"></i></span></div>
                    <div class="dash-title">Tableau de Bord</div>
                </div>
                <div class=" btn-ablack">
                    <div>
                        <span><i class=" icon-sv dash-icon"></i></span>
                    </div>
                    <div class="dash-title">Vos commandes</div>
                    </div>
                <div class=" btn-ablack">
                    <div><i class="fa-regular fa-handshake dash-icon"></i></div>
                    <div class="dash-title">Faire un don</div></div>
                <div class=" btn-ablack">
                   <div><i class="fa-solid fa-user-group dash-icon"></i></div>
                   <div>Espace Compte</div></div>
                <div class=" btn-ablack">
                   <div><img src="{{asset('images/icons/exit-svgrepo-com (1).svg')}}" class="dash-icon" alt=""></div>
                   <div class="dash-title">Se Deconnecte</div></div>
            </div>
        </div>
    </div>
@endsection
