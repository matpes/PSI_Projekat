@extends('pictureBase')


@section('cenaIDugmici')

    <div class="opisSlike pozicijaDugmadiSlika">


        <form action="{{$picture->id}}/edit" method="get" class="form-group">
            {{--                <input type="hidden" name="_method" value="POST">--}}
            <label for="mojaCena" class="cenaText">Cena:</label>
            <label for="" class="cenaLable">{{$picture->cena}}</label>
            <label for="mojaCena" class="cenaText">$</label>
            {{csrf_field()}}
            @if($bought)

                <input disabled type="submit" name="ubaciUKorpu" value="UBACI U KORPU"
                       class="form-control  kuplenoDugmic">
            @else
                <input type="submit" name="ubaciUKorpu" value="UBACI U KORPU"
                       class="form-control dugmiciSlika btn-dark">
            @endif
            <br>
            <input type="button" name="komentari" value="KOMENTARI" class="form-control dugmiciSlika btn-dark">
        </form>

    </div>


@endsection