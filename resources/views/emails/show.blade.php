<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/app.css">
    <title>Mail Contact</title>
</head>
<body>
    @include('inc.nav')
    <div class="text-center" style="width:800px; margin:0 auto;">
        <form class="form" action="/emailcontact" method="POST">
            @csrf
        <!-- <div class="form-group mx-sm-3 mb-2">
            <label for="email" class="sr-only">Email</label>
            <input type="text"  class="form-control" name="email" placeholder="email@example.com">
        </div> -->
        <div class="form-group">
            <label for="email">The Website Contacts</label>
                <select class="form-control" id="exampleFormControlSelect1" name="email">
                    @forelse($contacs as $contact)
                        <option value="{{$contact->email}}">{{$contact->name}}</option>

                    @empty
                        <option value="foo@example.com">foo@example.com</option>
                    @endforelse
            </select>
        </div>
        @if(session('message'))
            <div class="text-success text-xs">
                {{session('message')}}
            </div>
        @endif
        @error('email')
        <div class="text-danger text-xs">
            {{$message}}
        </div>
        @enderror
        <button type="submit" class="btn btn-primary mb-2 form-center">Sennd Email</button>
        </form>
    </div>
</body>
</html>