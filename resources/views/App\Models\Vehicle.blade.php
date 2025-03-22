
<?php
$makeModels = get_class($targetClassInstance)::getMakeAndModels();
?>
@if ($makeModels)
<form action="{{ url('/submit') }}" enctype="multipart/form-data" id="vehicle" name="vehicle" class="max-w-sm mx-auto">
    @csrf
    <div class="vehicle_make_container">
        <label for="make" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select vehicle make</label>
        <select id="make" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            @foreach ($makeModels as $make => $model)
                <option value="{{ $make }}">{{ $make }}</option>  
            @endforeach
        </select>
    </div>

    <div class="vehicle_model_container" style="display:none;">
        <label for="model" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select vehicle model</label>
        <select id="model" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </select>
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
    </div>
</form>
@endif
  
  <script type="text/javascript">
    var makeModels = <?php echo json_encode($makeModels); ?>;
    var curPattern = <?php echo json_encode($patternObj->getName()); ?>;
    // var makeModels = {{ Js::from($makeModels) }};
    window.onload = () => {
        function updateModel(make) {
            const curModels = makeModels[make];
            // console.log('curModels to render',curModels);
            selectModel.innerHTML = '';
            curModels.forEach((model, i) => {
                let option = document.createElement('option');
                option.value = option.text = model;
                selectModel.appendChild(option);
            });
            makeDiv.style.display = 'block';
        };
        console.log('vehicle blade: window loaded. makeModel',makeModels);
        const form = document.querySelector("form#vehicle");
        // console.log(form);
        const makeDiv = form.querySelector('div.vehicle_model_container');
        const selectMake = form.querySelector('select#make');
        const selectModel = form.querySelector('select#model');
        const submitButton = form.querySelector('button[type="submit"]');
        const selectedMake = selectMake.options[0].value;
        console.log(`firstMake`,selectedMake);

        selectMake.addEventListener('change', function(ev) {
            // console.log('select changed,',ev.target.value);
            updateModel(ev.target.value);            
        });

        $("form#vehicle").submit(function(e) {
            e.preventDefault();

            const _token = $("input[name='_token']").val();
            const actionUrl = form.getAttribute('action');
            console.log(`vehicle form submit(): token:make:model:actionUrl`,_token, selectMake.value,selectModel.value,actionUrl);
            $.ajax({
                type: "POST",
                url: actionUrl,
                data: {"_token": _token, "pattern": curPattern, "selectedMake": selectMake.value, "selectedModel": selectModel.value},
                success: function(response) {
                    console.log(response);
                },
                error: function(response) {
                    console.log(response);
                }
            });
        });
        // submitButton.addEventListener('click', function(ev) {
        //     ev.preventDefault();
        //     console.log(`submit btn clicked: selectMake:selectModel`,selectMake.value,selectModel.value);
        //     const action = form.getAttribute('action');
        //     console.log('action',action);
        //     const xhttp = new XMLHttpRequest();
        //     xhttp.open("POST", action, true);
        //     // xhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        //     // xhttp.onload = function(val) {
        //     //     console.log('xhttp.onload(): val',val);
        //     // };
        //     xhttp.onreadystatechange = function() {//Call a function when the state changes.
        //         // console.log(`onreadystate changed`,xhttp);
        //         if(xhttp.readyState == 4 && xhttp.status == 200) {
        //             const data = JSON.parse(xhttp.responseText);
        //             alert(data.status + " - " + data.message);
        //         }
        //         if (xhttp.status == 500) {
        //             alert(xhttp.responseText);
        //         }
        //     }
        //     // xhttp.send(`make=${selectMake.value}&model=${selectModel.value}`);
        //     const formData = new FormData(form);
        //     console.log('formDate',formData);
        //     xhttp.send("make=some make");
        //     return false;
        // });

        updateModel(selectedMake);
    }
  </script>