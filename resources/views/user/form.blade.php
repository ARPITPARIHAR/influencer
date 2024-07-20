<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Influencer Form</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        .background {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f7f7f7;
        }
        .container {
            background: white;
        }
        .input {
            display: block;
            width: 100%;
            padding: 0.5rem;
            margin-top: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 0.25rem;
        }
        .submitbtn, .addbtn {
            background-color: #4CAF50;
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 0.25rem;
            cursor: pointer;
        }
        .submitbtn:hover, .addbtn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<div class='background'>
    <div class="container mx-auto my-5 p-[3rem] h-auto sm:w-[60%] border border-black rounded-3xl shadow-slate-500 shadow-[10px_10px_10px_0]">
        <h1 class="text-4xl font-bold text-black mb-4 text-center">INFLUENCER FORM</h1>
        <hr />
        {{-- <form action="{{ route('your.route.name') }}" method="POST" enctype="multipart/form-data"> --}}
            @csrf
            <div class="flex justify-center items-center cursor-pointer h-[200px] w-[200px] bg-gray-300 rounded-full m-7">
                <input type="file" accept="image/*" name="image" hidden id="fileInput">
                <label for="fileInput" class="cursor-pointer">
                    <span class="text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 4a3 3 0 100 6 3 3 0 000-6zM4 8a6 6 0 1111.98.263A7 7 0 1010 19v-1a6 6 0 01-6-6z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </label>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-2">
                <div>
                    <label for="firstName" class="block text-black text-3xl font-bold mb-2">First Name</label>
                    <input type="text" id="firstName" name="firstName" required class="input">
                </div>
                <div>
                    <label for="lastName" class="block text-black text-3xl font-bold mb-2">Last Name</label>
                    <input type="text" id="lastName" name="lastName" required class="input">
                </div>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-black text-3xl font-bold mb-2 mt-2">Email</label>
                <input type="email" id="email" name="email" required class="input">
            </div>
            <div class="mb-4">
                <label for="contactNumber" class="block text-black text-3xl font-bold mb-2 mt-2">Contact Number</label>
                <input type="number" id="contactNumber" name="contactNumber" required class="input">
            </div>
            <h2 class="text-3xl text-black font-bold mb-2">Social Media Handles</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xl text-black">
                @foreach(['facebook', 'instagram', 'twitter', 'youtube', 'tiktok', 'snapchat'] as $handle)
                    <div>
                        <input type="checkbox" id="{{ $handle }}" name="socialMediaHandles[{{ $handle }}]" class="input mr-2">
                        <label for="{{ $handle }}">{{ ucfirst($handle) }}</label>
                        <input type="text" name="{{ $handle }}Input" placeholder="Enter Profile Id" class="input mt-2 hidden">
                    </div>
                @endforeach
            </div>
            <h2 class="text-3xl text-black font-bold mb-2 pt-3">Content Type</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xl text-black">
                @foreach(['Comedy', 'Motivation', 'Series', 'Movies', 'Vlogs', 'Gaming', 'Animation', 'Education', 'Food Reciepes', 'Rhymes'] as $type)
                    <div>
                        <input type="checkbox" id="{{ strtolower($type) }}" name="contentType[]" value="{{ $type }}" class="mr-2">
                        <label for="{{ strtolower($type) }}">{{ $type }}</label>
                    </div>
                @endforeach
            </div>
            <div class="mb-4 pt-3">
                <label for="other" class="block text-black text-2xl font-bold mb-2">Add Other Content Type</label>
                <div class="flex items-center">
                    <input type="text" id="other" name="other" class="input" placeholder="Enter other content type">
                    <button type="button" class="addbtn ml-2">Add</button>
                </div>
            </div>
            <div class="flex justify-center">
                <button type="submit" class="submitbtn">Submit</button>
            </div>
        </form>
    </div>
</div>
<script>
    document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
        checkbox.addEventListener('change', (e) => {
            const input = e.target.nextElementSibling.nextElementSibling;
            if (e.target.checked) {
                input.classList.remove('hidden');
            } else {
                input.classList.add('hidden');
            }
        });
    });

    document.querySelector('.addbtn').addEventListener('click', () => {
        const otherInput = document.querySelector('#other');
        if (otherInput.value.trim() !== '') {
            const container = document.createElement('div');
            container.classList.add('mb-4');
            container.innerHTML = `<input type="text" value="${otherInput.value}" class="input" readonly>`;
            document.querySelector('form').insertBefore(container, otherInput.parentElement.parentElement.nextSibling);
            otherInput.value = '';
        }
    });
</script>
</body>
</html>
