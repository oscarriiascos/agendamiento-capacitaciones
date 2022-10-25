<x-app-layout>     
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel programación') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="w-full sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="flex flex-row justify-center flex-wrap">
                        
                    @if (Auth::user()['is_admin']) 
                        <div class="flex justify-center w-[45%] m-4 p-4">
                            <form action="course/save" name="course" method="post"  onsubmit="return validate()">
                                @csrf
                                <div class="flex flex-col m-4 text-gray-700 font-semibold">
                                    <label for="course_name">Nombre de la clase</label>
                                    <input type="text" name="course_name" id="course_name" placeholder="Ej: Portugués A1" alt-name="Nombre de la clase" required>
                                </div>
    
                                <div class="flex flex-col m-4 text-gray-700 font-semibold">
                                    <label for="avaliable_quotas">Cupos disponibles</label>
                                    <input type="number" min="1" name="avaliable_quotas" id="avaliable_quotas" placeholder="Ej: 10" alt-name="Cupos disponibles" required>
                                </div>
    
                                <div class="flex flex-col m-4 text-gray-700 font-semibold">
                                    <label for="schedule">Horario asignado</label>
                                    <input type="datetime-local" name="schedule" id="schedule" min="{{now()}}" value="{{now()}}" alt-name="Horario asignado" required>
                                </div>           
                                
                                <div class="m-4">
                                    <button class="bg-indigo-500 hover:bg-indigo-600 cursor-pointer p-2 text-white font-bold">
                                        Guardar clase
                                    </button>
                                </div>                                   
                            </form>
                        </div>                                             
                    @endif
                    
                    <div class="flex flex-col w-[45%] m-4 p-4">
                        
                        <div class="flex-row mx-auto p-2">
                            <h1 class="text-lg font-bold text-indigo-600">Programación actual</h1>
                        </div>

                        <section id="schedule">
                            @if (!empty($courses))                                                    
                            <ul class="list-decimal mt-4">
                                @foreach ($courses as $course)
                                  
                                @if ($course->class_date < now())
                                    @php
                                        $default_connector = 'hace';
                                        $disabled_class = 'text-gray-400';
                                    @endphp
                                @else
                                    @php
                                        $default_connector = 'en';
                                        $disabled_class = 'text-gray-600';
                                    @endphp
                                @endif
                                    <details class="{{$disabled_class}}">
                                        <summary class="mt-4">
                                            <b>{{ $course->class_name }}</b>, {{ $default_connector }} 
                                            {{ \Carbon\Carbon::parse($course->class_date)->diffForHumans(now(), true, false) }}

                                            @if ($course->status)
                                                @php
                                                    $buttonText = 'Cancelar inscripción';
                                                    $buttonStyle = 'bg-red-500';
                                                @endphp
                                            @else
                                                @php
                                                    $buttonText = 'Incribirme'; 
                                                    $buttonStyle = 'bg-indigo-500';                                              
                                                @endphp
                                            @endif

                                            <button class="p-1 rounded-md text-white {{$buttonStyle}}" onclick="updateSubscription({{$course->id}})">{{$buttonText}}</button>                                                

                                        </summary>
                                        <p class="ml-4">Fecha {{ \Carbon\Carbon::parse($course->class_date)->format('d/m/Y - g:i A') }}</p>
                                        <p class="ml-4">
                                            Hay {{ $course->enrolled_students }} inscritos, quedan de 
                                            {{ $course->avaliable_quotas - $course->enrolled_students }} cupos.</p>
                                    </details>   
                                @endforeach
                            </ul>
                        @endif                            
                        </section>
                    </div>
                  </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script src="{{ asset('js/validationsHandler.js') }}" defer></script>
<script src="{{ asset('js/subscriptionHandler.js') }}" defer></script>
