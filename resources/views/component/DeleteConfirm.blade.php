@if(!$params) $params= [] @endif

<div class="absolute bg-opacity-60 bg-slate-900 top-0 left-0 w-full h-full flex items-start justify-center md:items-center ">
    <form action="{{route($route, $params)}}" method="post"
          class="w-full md:w-1/2 bg-opacity-60 bg-slate-50 p-3 md:p-12 border border-black border-2 rounded-lg">
        @csrf
        @method('DELETE')
        <p class="font-black">
            {{__($confirm_message)}}
        </p>
        <div class="flex justify-evenly my-6 ">
            <input type="hidden" name="_id" value="{{$id}}"/>
            <input type="submit" name="_accept" value="{{__('Yes')}}"
                   class="success py-2 px-5 rounded-lg w-1/3  "/>
            <input type="submit" name="_decline" value="{{__('No')}}"
                   class="danger py-2 px-5 rounded-lg w-1/3"/>
        </div>
<!--        <aside class="font-black mt-5">
            <h3>Attention, la facture n'apparaîtra plus mais sera conservée en base de données</h3>
        </aside> -->
    </form>
</div>