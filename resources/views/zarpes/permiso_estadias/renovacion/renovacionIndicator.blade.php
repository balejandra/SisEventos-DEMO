@push('scripts')
    <script src="{{asset('js/zarpe.js')}}"></script>
@endpush
<ul class="row px-3 mb-3" id="progressbar">
    <li class="col text-center p-2 mx-2 {{ $count>=1 ? 'active' : '' }}">Primera Vez</li>
    <li class="col text-center p-2 mx-2 {{ $count>=2 ? 'active' : '' }}">Renovación 2</li>
    <li class="col text-center p-2 mx-2 {{ $count>=3 ? 'active' : '' }}">Renovación 3</li>
    <li class="col text-center p-2 mx-2 {{ $count>=4 ? 'active' : '' }}">Ultima Renovación</li>

</ul>
