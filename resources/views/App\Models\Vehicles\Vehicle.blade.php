
@php
$makeModels = get_class($targetClassInstance)::getData();
@endphp
<div class="vehicle_section">
    <form action="{{ url('/') }}" enctype="multipart/form-data" id="vehicle" name="vehicle" class="max-w-sm mx-auto">
        @csrf
        <div class="vehicle_make_container">
            <label for="make" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select vehicle make</label>
            <select id="make" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @foreach ($makeModels as $make => $model)
                    <option value="{{ $make }}">{{ $make }}</option>  
                @endforeach
            </select>
        </div>

        <div class="vehicle_model_container mt-2">
            <label for="model" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select vehicle model</label>
            <select id="model" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </select>
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto mt-4 px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </div>
    </form>

    <div class="hidden vehicle_submission mt-4 p-2 max-w-sm mx-auto">
        <div class="description flex flex-wrap">
            <div class="instance1">
                <h5 class="mb-2  font-bold tracking-tight text-gray-900 dark:text-white"></h5>
                <p class="instance1 text-center text-gray-500 dark:text-gray-400">
                </p>
                <blockquote class="instance1 p-4 my-4 border-s-4 border-gray-300 bg-gray-50 dark:border-gray-500 dark:bg-gray-800">
                    <p class="text-xl italic font-medium leading-relaxed text-gray-900 dark:text-white"></p>
                </blockquote>
            </div>
            <div class="instance2">
                <p class="instance2 text-center text-gray-500 dark:text-gray-400">
                </p>
                <blockquote class="instance2 p-4 my-4 border-s-4 border-gray-300 bg-gray-50 dark:border-gray-500 dark:bg-gray-800">
                    <p class="text-xl italic font-medium leading-relaxed text-gray-900 dark:text-white"></p>
                </blockquote>
            </div>                
        </div>
        <div class="outputFormatter max-w-2xl">
            <h5 class="mb-2  font-bold tracking-tight text-gray-900 dark:text-white">Strategy Design Pattern is used to display the following formatter.</h5>
            <p class="font-normal text-gray-700 dark:text-gray-400"></p>
        </div>
    </div>
</div>
<script type="text/javascript">
    var makeModels = <?php echo json_encode($makeModels); ?>;
    var curPattern = <?php echo json_encode($patternObj->getName()); ?>;
    var curPatternCategory = <?php echo json_encode($patternObj->getCategory()); ?>;

    window.onload = () => {
        function updateModel(make) {
            const curModels = makeModels[make];
            selectModel.innerHTML = '';
            curModels.forEach((model, i) => {
                let option = document.createElement('option');
                option.value = option.text = model;
                selectModel.appendChild(option);
            });
            makeDiv.style.display = 'block';
        };

        const form = document.querySelector("form#vehicle");
        const makeDiv = form.querySelector('div.vehicle_model_container');
        const selectMake = form.querySelector('select#make');
        const selectModel = form.querySelector('select#model');
        const submitButton = form.querySelector('button[type="submit"]');
        const selectedMake = selectMake.options[0].value;

        selectMake.addEventListener('change', function(ev) {
            updateModel(ev.target.value);            
        });

        $("form#vehicle").submit(function(e) {
            e.preventDefault();

            const _token = $("input[name='_token']").val();
            let actionUrl = form.getAttribute('action');
            if (curPatternCategory === 'creational') {
                actionUrl += '/create';
            } else if (curPatternCategory === 'behavioral') {
                actionUrl += '/behave';
            } else {
                throw new Error("Unsupported Design Pattern Behavior");
            }
            console.log(`vehicle form submit(): token:make:model:actionUrl`,_token, selectMake.value,selectModel.value,actionUrl);
            $.ajax({
                type: "POST",
                url: actionUrl,
                data: {"_token": _token, "pattern": curPattern, "category": curPatternCategory, "selectedMake": selectMake.value, "selectedModel": selectModel.value},
                success: function(response) {
                    console.log(response);
                    const submissionDiv = document.querySelector("div.vehicle_submission");
                    const compareNotice = submissionDiv.querySelector("div.description h5");
                    const p1 = submissionDiv.querySelector("div.description p.instance1");
                    const p2 = submissionDiv.querySelector("div.description p.instance2");
                    const block1 = submissionDiv.querySelector("div.description blockquote.instance1 p");
                    const block2 = submissionDiv.querySelector("div.description blockquote.instance2 p");
                    const outputFormatter = document.querySelector("div.vehicle_submission div.outputFormatter p");
                    const instance2Div = submissionDiv.querySelector("div.description div.instance2");
                    p1.innerHTML = "Vehicle instance 1";
                    block1.innerHTML = response.instance1_description;
                    outputFormatter.innerHTML = response.outputFormatter;
                    if (response?.instance2_description) {
                        p2.innerHTML = "Vehicle instance 2";
                        block2.innerHTML = response.instance2_description;
                        if (curPattern === 'singleton') {
                            compareNotice.innerHTML = "For the Singleton Pattern notice that the instance ids are the same for the two instances that were created.";
                        } else if (curPattern === 'factory') {
                            compareNotice.innerHTML = "For the Factory Pattern notice that the instance ids are dirrent for the two instances that were created.";
                        }
                    } else {
                        instance2Div.classList.add('hidden');
                    }
                    submissionDiv.classList.remove('hidden');
                },
                error: function(response) {
                    console.log(response);
                }
            });
        });

        updateModel(selectedMake);
    }
</script>