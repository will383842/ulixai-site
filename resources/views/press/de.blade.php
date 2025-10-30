@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Espace Presse – Deutsch</h1>

    @if($pressItems->isEmpty())
        <p class="text-gray-600">🧐 Aucun document pour l’instant. Revenez bientôt avec votre carnet !</p>
    @else
        <ul class="space-y-4">
            @foreach($pressItems as $item)
                <li class="border p-4 rounded">
                    <h2 class="font-semibold text-lg">{ $item->title }</h2>
                    <p class="text-sm text-gray-700">{ $item->description }</p>
                    @if($item->pdf)
                        <a href="{ route('press.asset', ['id' => $item->id, 'type' => 'pdf']) }" class="text-blue-600 underline">📄 Télécharger le PDF</a>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
@endsection
