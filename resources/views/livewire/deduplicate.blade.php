<div >

    hello


    <div class="container mx-auto mt-5">
        <div class="overflow-x-auto">
            <button class="button" wire:click='getData2' class="button"> click me to view data </button>
            <button style = "border: 1px solid rgb(120, 30, 60); padding: 10px; " class="button" wire:click='getData2' class="button"> click me to view duplicates </button>

            @isset($this->data2)

            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        National ID
                    </tr>
                    <tr scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        Count
                    </tr>
                </thead>
                @foreach($this->data2 as $d)
                <tr >

                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white"> {{ $d->national_id }} </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white"> {{ $d->p_count }} </td>
                </tr>
                @endforeach
            </table>


            @endif
                @isset($this->data)
                <table class="min-w-full table-auto border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">

                          <th class="w-1/4 border border-gray-300 px-4 py-2 text-center">National Id</th>
                          <th class="w-1/4 border border-gray-300 px-4 py-2 text-center">Fullname</th>
                          <th class="w-1/4 border border-gray-300 px-4 py-2 text-center">Governate</th>
                          <th class="w-1/4 border border-gray-300 px-4 py-2 text-center">Value</th>
                        </tr>
                      </thead>
                      <tbody>
            @foreach($this->data as $ben)
                <tr class="bg-blue-100">
                    <td class="border border-gray-300 px-4 py-2 text-center">
                         {{ $ben->national_id}}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">
                        {{ $ben->fullname}}
                    </td>
                    <td class="border border-gray-300 px-4 py-2 text-center">
                        {{ $ben->governate}}

                    </td>
                    <td class="border border-gray-300 px-4 py-2 text-center">  {{ $ben->value}}</td>
                  </tr>
                </tbody>
            </table>
                  @endforeach
                  @endif


        </div>

</div>


<div>

    {{$this->message}}
</div>
<div>
   {{$this->table}}
</div>
</div>
