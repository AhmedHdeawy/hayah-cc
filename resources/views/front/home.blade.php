@extends('layouts.master')

@section('content')

<main class='homepage'>

    @include('front.slider');

    <section class='benefits'>
        <div class='container'>
            <h2> {{ getInfoByKey('benefits_title')->infos_title }} </h2>
            <div class='row'>
                <div class='col-lg-10 mx-auto'>
                    <div class='row mb-4'>
                        <div class='col-md-4 mb-md-0 mb-4'>
                            <h3> {{ getInfoByKey('benefits_1')->infos_title }} </h3>
                            <p> {{ getInfoByKey('benefits_1')->infos_desc }} </p>
                        </div>
                        <div class='col-md-4 mb-md-0 mb-4'>
                            <h3> {{ getInfoByKey('benefits_2')->infos_title }} </h3>
                            <p> {{ getInfoByKey('benefits_2')->infos_desc }} </p>
                        </div>
                        <div class='col-md-4 mb-md-0'>
                            <h3> {{ getInfoByKey('benefits_3')->infos_title }} </h3>
                            <p> {{ getInfoByKey('benefits_3')->infos_desc }} </p>
                        </div>
                    </div>
                    <div class='row mt-3 mb-4'>
                        <div class='col-lg-2 col-md-3 my-md-auto mb-4'>
                            <img alt='' class='img-fluid' src='assets/images/mob-app.jpeg'>
                        </div>
                        <div class='col-lg-1 d-lg-block d-none'></div>
                        <div class='col-lg-9 col-md-8 my-md-auto mb-4'>
                            <h4> {{ getInfoByKey('benefits_sub_1')->infos_title }} </h4>
                            <div class='row'>
                                <div class='col-md-6'>
                                    <div class='text'>
                                        <h3> {{ getInfoByKey('benefits_4')->infos_title }} </h3>
                                        <p> {{ getInfoByKey('benefits_4')->infos_desc }} </p>
                                    </div>
                                </div>
                                <div class='col-md-6'>
                                    <div class='text'>
                                        <h3> {{ getInfoByKey('benefits_5')->infos_title }} </h3>
                                        <p> {{ getInfoByKey('benefits_5')->infos_desc }} </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='row mt-3 mb-4'>
                        <div class='col-lg-9 col-md-8 my-md-auto mb-4'>
                            <h4> {{ getInfoByKey('benefits_sub_2')->infos_title }} </h4>
                            <div class='row'>
                                <div class='col-md-6 mb-md-0 mb-3'>
                                    <div class='text'>
                                        <img alt='Classroom Icon' class='img-fluid' src='assets/images/classroom.png'>
                                    </div>
                                </div>
                                <div class='col-md-6'>
                                    <div class='text'>
                                        <h3> {{ getInfoByKey('benefits_6')->infos_title }} </h3>
                                        <p> {{ getInfoByKey('benefits_6')->infos_desc }} </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='col-lg-1 d-lg-block d-none'></div>
                        <div class='col-lg-2 col-md-3 my-md-auto mb-4'>
                            <img alt='' class='img-fluid' src='assets/images/mob-app.jpeg'>
                        </div>
                    </div>
                    <div class='row mt-3'>
                        <div class='col-lg-2 col-md-3 my-md-auto mb-4'>
                            <img alt='' class='img-fluid' src='assets/images/mob-app-2.jpeg'>
                        </div>
                        <div class='col-lg-1 d-lg-block d-none'></div>
                        <div class='col-lg-9 col-md-8 my-md-auto'>
                            <h4> {{ getInfoByKey('benefits_sub_3')->infos_title }} </h4>
                            <div class='benefits-con'>
                                <div class='text'>
                                    <h3> {{ getInfoByKey('specialization_1')->infos_title }} </h3>
                                </div>
                                <div class='text'>
                                    <h3> {{ getInfoByKey('specialization_2')->infos_title }} </h3>
                                </div>
                                <div class='text'>
                                    <h3> {{ getInfoByKey('specialization_3')->infos_title }} </h3>
                                </div>
                                <div class='text'>
                                    <h3> {{ getInfoByKey('specialization_4')->infos_title }} </h3>
                                </div>
                                <div class='text'>
                                    <h3> {{ getInfoByKey('specialization_5')->infos_title }} </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class='register'>
        <div class='container'>
            <h2> {{ getInfoByKey('subscription')->infos_desc }} </h2>
            <a class='btn' href="{{ route('register-subscriber') }}"> {{ getInfoByKey('subscription')->infos_title }} </a>
        </div>
    </section>
</main>

@endsection
