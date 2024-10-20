<div >



    <div class="container mx-auto mt-5">
        <div class="overflow-x-auto">

            <form wire:submit.prevent="importCSV">
                @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <input type="file" wire:model="csv_file">
        @error('csv_file')
        <span class="error">{{ $message }}</span> @enderror

        <button  style = "margin-bottom: 10px; border: 1px solid rgb(37, 159, 165); padding: 10px; " type="submit" class="btn btn-primary mt-3">Import CSV</button>
    </form>
    <div wire:loading wire:target="csv_file">Uploading...</div>
            <br>



            <button style = "border: 1px solid rgb(120, 30, 60); padding: 10px; " class="button" wire:click='getData2' class="button"> click me to view duplicates </button>
<br>
            @isset($this->data2)

            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white"> National ID</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white"> Fullname </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white"> Count</td>
                    </tr>

                </thead>
                @foreach($this->data2 as $d)
                <tr >

                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white"> {{ $d->national_id }} </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white"> {{ $d->fullname }} </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white"> {{ $d->p_count }} </td>
                </tr>
                @endforeach
            </table>


            @endif
                @isset($this->csv_data)
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
            @foreach($this->csv_data as $ben)
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
    @if(empty($this->csv_data))
    no data
    @endif
@if(!empty($this->csv_data))
data is here
{{count($this->csv_data)}}
@endif
    {{$this->message}}
</div>
<div>

</div>
</div>
