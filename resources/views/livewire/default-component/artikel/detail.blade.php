<div>

    <!-- component -->
    <style>
        .pt-\[17\%\] {
            padding-top: 17%;
        }

        .mt-\[-10\%\] {
            margin-top: -10%;
        }

        .pt-\[56\.25\%\] {
            padding-top: 56.25%;
        }
    </style>

    <main class="relative bg-white ">
        <div class="relative w-full top-0 pt-[17%] overflow-hidden border">
            <img class="absolute inset-0 object-cover object-top w-full h-full filter blur"
                 src="{{asset('storage/'.$artikel->cover)}}"
                 alt=""/>
        </div>

        <div class="mt-[-10%] max-w-7xl mx-auto">
            <div class="relative pt-[56.25%] overflow-hidden rounded-2xl">
                <img class="w-full h-full absolute inset-0 object-cover"
                     src="{{asset('storage/'.$artikel->cover)}}"
                     alt=""/>
            </div>
        </div>

        <article class="max-w-7xl mx-auto py-8 px-4 md:px-0">
            <h1 class="text-2xl font-bold">{{$artikel->judul}}</h1>
            <h2 class="mt-2 text-sm text-gray-500">{{\App\Models\User::find($artikel->creator_id)->name}}, {{\Carbon\Carbon::parse($artikel->created_at)->isoFormat('dddd DD MMMM YYYY')}}</h2>
            <div class="mt-4 ">
                {!! $artikel->content !!}
            </div>
        </article>
    </main>
</div>
