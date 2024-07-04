@extends('layouts.app')

@php
    use App\Models\PrestaTypeMission;use \App\Models\Role_user;
        $dejapresta = Role_user::where('user_id', Auth::id())->where('role_id', 4)->first();
        if(!$dejapresta){
            return redirect(route('welcome'));
        }

        use App\Models\TypePrestation;use Illuminate\Support\Facades\Auth;
        $typePrestations = TypePrestation::all();



        $typesdepresta = PrestaTypeMission::where('user_id', Auth::id())->pluck('type_prestation_id');
        $typesdeprestations = $typesdepresta->toArray();
@endphp


@section('content')
    <div class="flex flex-col justify-center items-center min-h-screen bg-gray-100">
        <div class="w-full max-w-2xl bg-white rounded-lg shadow-lg p-8">
                <div class="">
                    <h2 class="text-xl font-semibold text-center mb-4">Mes types de prestation</h2>
                    @foreach ($typePrestations as $typePrestation)
                        @if(in_array($typePrestation->id, $typesdeprestations))
                        <div class="mb-4">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="type_prestation[]" value="{{ $typePrestation->id }}"
                                       class="form-checkbox text-blue-500">
                                <span class="ml-2 text-gray-700">{{ $typePrestation->nom }} - {{ $typePrestation->description }} - Prérequis : {{ $typePrestation->prerequis }}</span>
                            </label>
                        </div>
                        @endif
                    @endforeach
                    <h1 class="text-xl font-semibold text-center mb-4"> Ajouter des types de prestation</h1>
                    <form action="{{ route('prestataire.modifstypespresta') }}" method="POST">
                        @csrf
                     @php $countpresta = 0; @endphp
                    @foreach ($typePrestations as $typePrestation)
                        @if(!in_array($typePrestation->id, $typesdeprestations))
                                @php $countpresta++; @endphp
                                <div class="mb-4 " >
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="type_prestation[]" value="{{ $typePrestation->id }}"
                                           class="form-checkbox text-blue-500">
                                    <span class="ml-2 text-gray-700">{{ $typePrestation->nom }} - {{ $typePrestation->description }} - Prérequis : {{ $typePrestation->prerequis }}</span>
                                </label>
                            </div>
                        @endif
                    @endforeach
                        @if($countpresta == 0)
                            <div>
                            <p>Vous avez acceptez tout les types de missions disponible</p>
                            </div>

                        @endif

                    <div class="flex justify-between">
                        <input type="submit" value="Soumettre"
                               class="w-full ml-2 bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-200">
                    </div>
            </form>
        </div>
    </div>
@endsection

