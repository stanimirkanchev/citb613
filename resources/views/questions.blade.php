@extends('layouts.app')

@section('title', 'Homepage')

@section('content')
<div class="questions">
    <div class="container">
        <div class="questions-wrapper">
            <div class="questions-item">
                <div class="question">Какво е стая на загадките?</div>
                <div class="answer">
                    Стаята на загадките пресъздава познатите компютърни escape the room games в реални условия. Това са
                    игри, при които участниците попадат в затворено пространство – най-често стая, мазе, таван, кула,
                    килия и др. – от което трябва да се намери изход.
                </div>
            </div>
            <div class="questions-item">
                <div class="question">Кой може да участва?</div>
                <div class="answer">Вие – ако се чувствате изКЛЮЧителни!</div>
            </div>
            <div class="questions-item">
                <div class="question">Как да резервирам час за участие?</div>
                <div class="answer">Събери своя екип според капацитета на избраната стая<br /><br />Избери свободен час
                    и попълни формата.</div>
            </div>
            <div class="questions-item">
                <div class="question">Каква е цената?</div>
                <div class="answer">Цените варират според стаите, изчисляват се според цената на човек зададена от
                    стаята и броя играчи</div>
            </div>
            <div class="questions-item">
                <div class="question">Изисква ли се предплащане?</div>
                <div class="answer">В нашият сайт не се изисква предплащане.</div>
            </div>
            <div class="questions-item">
                <div class="question">Може ли да се промени или отмени резервация?</div>
                <div class="answer">Моля да се свържете с нас, ако искате да направите промяна по резервацията.</div>
            </div>
        </div>
    </div>
</div>
@stop