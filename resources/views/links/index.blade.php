<x-app-layout>

    @include('session-messages')


    <div class="flex items-center bg-gray-50 dark:bg-gray-900" >
        <div class="container mx-auto">
            <div class="max-w-md mx-auto my-2 bg-white p-5 rounded-md shadow-sm">
                <div class="text-center">
                    <x-jet-validation-errors class="mb-4" />
                    <h1 class="my-3 text-xl font-semibold text-gray-700 dark:text-gray-200">Welcome</h1>
                    <p class="text-gray-400 dark:text-gray-400">Enter the link you want to save.</p>
                </div>
                <div class="">
                    <form action="/links" method="POST" id="form">
                        @csrf
                        <div class="mb-6">
                            <label for="title" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Title</label>
                            <input type="text" name="title" id="title" placeholder="Ex: Bigger Pockets" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                        </div>
                        <div class="mb-6">
                            <label for="url" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">URL</label>
                            <input type="text" name="url" id="url" placeholder="Ex: https://biggerpockets.com/articles/dirt-for-dirt-cheap" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                        </div>

                        <div class="mb-6">
                            <button type="submit" class="w-full px-3 py-4 text-white bg-indigo-500 rounded-md focus:bg-indigo-600 focus:outline-none">Save Link</button>
                        </div>
                        @if(count($links))
                            <p class="text-center text-gray-400">See your links below</p>
                        @endif

                    </form>
                </div>
            </div>
        </div>

                        {{---------------------------------------}}

    </div>


    <div class="flex items-center bg-gray-50 dark:bg-gray-900 mt-5">

        <div class="container mx-auto">

            @forelse($links as $link)
                <div class="max-w-md mx-auto my-2 bg-white p-5 rounded-md shadow-sm text-center" id="link-{{$link->id}}">

                    <br>
                    <div class="text-center">
                        <a href="{{$link->url}}" class="rounded p-3 m-2 text-blue-400" target="_blank">
                            <p class="my-3 text-xl font-semibold rounded border bg-blue-300 text-white p-3">{{$link->title}}</p>
                        </a>
                    </div>

                    <div class="text-center p-3">
                        <form action="/links/{{$link->id}}" method="POST" class="">
                            @csrf
                            @method("DELETE")
                            <button type="button" class="text-red-500 delete-link" data-item="#link-{{$link->id}}" data-id="{{$link->id}}">remove</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="max-w-md mx-auto my-10 bg-white p-5 rounded-md shadow-sm">
                    <div class="text-center">
                        <h1 class="my-3 text-xl font-semibold text-gray-700 dark:text-gray-200">No links yet...add some above</h1>
                    </div>
                </div>
            @endforelse

        </div>

    </div>
</x-app-layout>
<script>
    $('.delete-link').click(function (e) {
        let listItem = $(this).attr('data-item');
        let listItemId = $(this).attr('data-id');
        e.preventDefault();
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will have to add it again!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((deleteIt) => {
                if (deleteIt) {
                    swal("Deleting your link", {
                        icon: "success",
                    });

                    setTimeout(function () {
                        $('form').submit();
                    }, 1000);

                } else {
                    swal("Good choice...");
                }
            });

    });

    // $("form").submit(function(e){
    //     e.preventDefault();
    //     swal("deleting");
    // });
</script>
