
@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel panel-heading">

        </div>

        <div class="panel panel-body">

            {!! Form::open(array('route' => 'admin.assessments.store', 'method' => 'POST')) !!}


            <div class="row">
                <div class="col-xs-6 form-group">

                    {!! Form::label('date', 'Assessment date:'.'', ['class' => 'control-label']) !!}
                    {!! Form::date('date',old('date'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
                <div class="col-xs-6 form-group">

                    {!! Form::label('name', 'Interviewer Name:'.'', ['class' => 'control-label']) !!}

                    {!! Form::text('date',old('date'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>

            </div>
            <div class="row">

                <div class="col-xs-12 form-group">
                    {!! Form::label('department', 'Interview Department: '.'', ['class' => 'control-label']) !!}

                    <label>  {!! Form::radio('department', 'OPD',['class' => 'form-control'])  !!}OPD</label>

                    {!! Form::radio('department', 'ART Clinic')  !!}ART Clinic
                    {!! Form::radio('department', 'Laboratory')  !!}Laboratory
                    {!! Form::radio('department', 'Pharmacy/Logistics')  !!}Pharmacy/Logistics
                    {!! Form::radio('department', 'MCH')  !!}MCH
                    {!! Form::radio('department', 'other')  !!}other
                </div>


            </div>

            <div>

                <label>Details of participant </label>

                <table style="width: 100%;background-color: #eeeedf;" border="1">
                    <tbody>
                    <tr>
                        <td><strong>Name</strong></td>
                        <td>{!! Form::text('date',old('date'), ['class' => 'form-control', 'placeholder' => '']) !!}</td>
                    </tr>
                    <tr>
                        <td><strong>Job Title </strong></td>
                        <td>{!! Form::text('date',old('date'), ['class' => 'form-control', 'placeholder' => '']) !!}</td>
                    </tr>
                    <tr>
                        <td><strong>&nbsp;If health workers specify Cadre</strong></td>
                        <td>  {!! Form::radio('cadre', 'doctor')  !!}Doctor
                            {!! Form::radio('cadre', 'clinical officer')  !!}Clinical Officer
                            {!! Form::radio('cadre', 'registered midwife')  !!}Registered Midwife
                            {!! Form::radio('cadre', 'registered nurse')  !!}Registered Nurse
                            {!! Form::radio('cadre', 'enrolled nurse')  !!}Enrolled Nurse
                            {!! Form::radio('cadre', 'nursing assistants')  !!}Nursing Assistants
                            {!! Form::radio('cadre', 'lab technicians')  !!}Lab Technicians
                            {!! Form::radio('cadre', 'lab assistant')  !!}Lab Assistant
                            {!! Form::radio('cadre', 'pharmacy')  !!}Pharmacy Staff
                            {!! Form::radio('cadre', 'hia')  !!}Health Information Assistant
                            {!! Form::radio('cadre', 'other')  !!}Other Staff specify

                        </td>





                    </tr>
                    <tr>
                        <td><strong>Duration in service (in this district)</strong></td>

                        <td>
                            {!! Form::text('years',old('years'), ['class' => 'form-control', 'placeholder' => 'Years']) !!}
                            {!! Form::text('years',old('years'), ['class' => 'form-control', 'placeholder' => 'Months']) !!}
                            {!! Form::text('years',old('years'), ['class' => 'form-control', 'placeholder' => 'years of deployment']) !!}

                        </td>
                    </tr>
                    <tr>
                        <td><strong>Status of participant </strong></td>
                        <td>

                            {!! Form::radio('status', 'govt')  !!}Gov’t
                            {!! Form::radio('status', 'project')  !!}Project
                            {!! Form::radio('status', 'other')  !!}Other


                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;<strong>District Name</strong></td>
                        <td>{!! Form::text('district',old('district'), ['class' => 'form-control', 'placeholder' => '']) !!}</td>
                    </tr>
                    <tr>
                        <td>&nbsp;<strong>Name of organization </strong></td>
                        <td>{!! Form::text('organization',old('organization'), ['class' => 'form-control', 'placeholder' => '']) !!}</td>
                    </tr>
                    <tr>
                        <td>&nbsp;<strong>&nbsp;If Facility indicate level</strong></td>
                        <td>
                            {!! Form::radio('facility_level', 'rrh')  !!}RRH
                            {!! Form::radio('facility_level', 'district')  !!}District Hospital
                            {!! Form::radio('facility_level', 'hC4')  !!}HC IV
                            {!! Form::radio('facility_level', 'hC3')  !!}HC III
                            {!! Form::radio('facility_level', 'hC2')  !!}HC II




                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;<strong>Organization &nbsp;Ownership </strong></td>
                        <td>

                            {!! Form::radio('ownership', 'NGO')  !!}NGO
                            {!! Form::radio('ownership', 'PFP')  !!}PFP
                            {!! Form::radio('ownership', 'PFP')  !!}other
                        </td>
                    </tr>

                    </tbody>
                </table>
                <!-- DivTable.com -->
                <p>&nbsp;</p>
            </div>
            <div>
                <h4><strong>B: Training Needs Assessment:</strong> Indicate the trainings attended and rate on a scale 1 to 5 (where 1 is the least and 5 is the highest score) how the training improved your skills and knowledge. Also, state indicate any additional trainings needed by level of priority</h4>
            </div>

            <div>
                width: 100%
                <table style="width: 100%;" border="1" cellpadding="1">
                    <tbody>
                    <tr>

                        <td style="width: 98.0333px;background-color: #eeeedf;">&nbsp;<strong>Topical area of Paediatric and Adolescent health care </strong></td>
                        <td style="width: 80.8px;">
                            <table style="background-color: #eeeedf;">
                                <tbody>
                                <tr>
                                    <td>
                                        <p><strong>a) How often do you provide this services</strong></p>
                                        <p>1.&nbsp;&nbsp;&nbsp;&nbsp; Not at all</p>
                                        <p>2.&nbsp;&nbsp;&nbsp;&nbsp; Less often</p>
                                        <p>3.&nbsp;&nbsp;&nbsp;&nbsp; Often</p>
                                        <p>4.&nbsp;&nbsp;&nbsp;&nbsp; More often</p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            Always&nbsp;</td>
                        <td style="width: 85.5333px;background-color: #eeeedf;">&nbsp;
                            <table >
                                <tbody>
                                <tr>
                                    <td>
                                        <strong>b) Have you attended any training in this area in the last three years </strong>
                                        <strong>(2017-2019 ) ) </strong>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                        <td style="width: 90.5167px;">
                            <table style="background-color: #eeeedf;">
                                <tbody>
                                <tr>
                                    <td>
                                        <p><strong>c) Did you receive a mentorship in the respective service areas </strong></p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <em>(Tick Yes or NO)</em>&nbsp;</td>
                        <td style="width: 82.7667px;background-color: #eeeedf;"><strong>d) On scale (1 (least) to 5 (high), Rate how the training or mentorship improved your skills and knowledge to deliver better quality of services </strong><em>(circle one for each topic trained or mentored)</em>&nbsp;</td>
                        <td style="width: 93.8833px;">
                            <table style="background-color: #eeeedf;">
                                <tbody>
                                <tr>
                                    <td>
                                        <p><strong>Would you recommend trainings in this area for other staff</strong></p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <strong><em>(Tick Yes or NO)</em></strong></td>

                    </tr>
                    <tr>
                        <td style="width: 98.0333px;">&nbsp;Psychosocial care and support for adolescents&nbsp;</td>
                        <td style="width: 80.8px;">

                            {!! Form::radio('how_often1', 1)  !!}1
                            {!! Form::radio('how_often1', 2)  !!}2
                            {!! Form::radio('how_often1', 3)  !!}3
                            {!! Form::radio('how_often1', 4)  !!}4
                        </td>
                        <td style="width: 85.5333px;">
                            {!! Form::radio('attendance', 'yes')  !!}yes
                            {!! Form::radio('attendance','no' )  !!}no
                        </td>
                        <td style="width: 90.5167px;">
                            {!! Form::radio('attendance', 'yes')  !!}yes
                            {!! Form::radio('attendance','no' )  !!}no
                        </td>
                        <td style="width: 82.7667px;">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="star-rating">
                                        <span class="fa fa-star-o" data-rating="1"></span>
                                        <span class="fa fa-star-o" data-rating="2"></span>
                                        <span class="fa fa-star-o" data-rating="3"></span>
                                        <span class="fa fa-star-o" data-rating="4"></span>
                                        <span class="fa fa-star-o" data-rating="5"></span>
                                        <input type="hidden" name="whatever2" class="rating-value" value="1.9">
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td style="width: 93.8833px;">
                            {!! Form::radio('attendance', 'yes')  !!}yes
                            {!! Form::radio('attendance','no' )  !!}no
                        </td>

                    </tr>
                    <tr>
                        <td style="width: 98.0333px;">&nbsp;
                            <table>
                                <tbody>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                </tbody>
                            </table>
                            Behavior change and HIV risk reduction for adolescents&nbsp;</td>
                        <td style="width: 80.8px;">
                            {!! Form::radio('how_often2', 1)  !!}1
                            {!! Form::radio('how_often2', 2)  !!}2
                            {!! Form::radio('how_often2', 3)  !!}3
                            {!! Form::radio('how_often2', 4)  !!}4
                        </td>
                        <td style="width: 85.5333px;">
                            {!! Form::radio('attendance', 'yes')  !!}yes
                            {!! Form::radio('attendance','no' )  !!}no
                        </td>
                        <td style="width: 90.5167px;">
                            {!! Form::radio('attendance', 'yes')  !!}yes
                            {!! Form::radio('attendance','no' )  !!}no
                        </td>
                        <td style="width: 82.7667px;">&nbsp;</td>
                        <td style="width: 93.8833px;">
                            {!! Form::radio('attendance', 'yes')  !!}yes
                            {!! Form::radio('attendance','no' )  !!}no
                        </td>

                    </tr>
                    <tr>
                        <td style="width: 98.0333px;">&nbsp;
                            <table>
                                <tbody>
                                <tr>
                                    <td>
                                        <p>&nbsp;</p>
                                        <p>1.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ART adherence, preparation, monitoring and support for PLHIV</p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                        <td style="width: 80.8px;">
                            {!! Form::radio('how_often3', 1)  !!}1
                            {!! Form::radio('how_often3', 2)  !!}2
                            {!! Form::radio('how_often3', 3)  !!}3
                            {!! Form::radio('how_often3', 4)  !!}4
                        </td>
                        <td style="width: 85.5333px;">
                            {!! Form::radio('attendance', 'yes')  !!}yes
                            {!! Form::radio('attendance','no' )  !!}no
                        </td>
                        <td style="width: 90.5167px;">
                            {!! Form::radio('attendance', 'yes')  !!}yes
                            {!! Form::radio('attendance','no' )  !!}no
                        </td>
                        <td style="width: 82.7667px;">&nbsp;</td>
                        <td style="width: 93.8833px;">
                            {!! Form::radio('attendance', 'yes')  !!}yes
                            {!! Form::radio('attendance','no' )  !!}no
                        </td>

                    </tr>
                    <tr>
                        <td style="width: 98.0333px;">&nbsp;&nbsp;HIV status disclosure&nbsp;</td>
                        <td style="width: 80.8px;">
                            {!! Form::radio('how_often4', 1)  !!}1
                            {!! Form::radio('how_often4', 2)  !!}2
                            {!! Form::radio('how_often4', 3)  !!}3
                            {!! Form::radio('how_often4', 4)  !!}4
                        </td>
                        <td style="width: 85.5333px;">
                            {!! Form::radio('attendance', 'yes')  !!}yes
                            {!! Form::radio('attendance','no' )  !!}no
                        </td>
                        <td style="width: 90.5167px;">
                            {!! Form::radio('attendance', 'yes')  !!}yes
                            {!! Form::radio('attendance','no' )  !!}no
                        </td>
                        <td style="width: 82.7667px;">&nbsp;</td>
                        <td style="width: 93.8833px;">
                            {!! Form::radio('attendance', 'yes')  !!}yes
                            {!! Form::radio('attendance','no' )  !!}no
                        </td>

                    </tr>
                    <tr>
                        <td style="width: 98.0333px;">&nbsp;Addressing HIV stigma and discrimination&nbsp;</td>
                        <td style="width: 80.8px;">
                            {!! Form::radio('how_often5', 1)  !!}1
                            {!! Form::radio('how_often5', 2)  !!}2
                            {!! Form::radio('how_often5', 3)  !!}3
                            {!! Form::radio('how_often5', 4)  !!}4

                        </td>
                        <td style="width: 85.5333px;">
                            {!! Form::radio('attendance', 'yes')  !!}yes
                            {!! Form::radio('attendance','no' )  !!}no
                        </td>
                        <td style="width: 90.5167px;">
                            {!! Form::radio('attendance', 'yes')  !!}yes
                            {!! Form::radio('attendance','no' )  !!}no
                        </td>
                        <td style="width: 82.7667px;">&nbsp;</td>
                        <td style="width: 93.8833px;">
                            {!! Form::radio('attendance', 'yes')  !!}yes
                            {!! Form::radio('attendance','no' )  !!}no
                        </td>

                    </tr>
                    <tr>
                        <td style="width: 98.0333px;">&nbsp;Retention in care&nbsp;</td>
                        <td style="width: 80.8px;">
                            {!! Form::radio('how_often6', 1)  !!}1
                            {!! Form::radio('how_often6', 2)  !!}2
                            {!! Form::radio('how_often6', 3)  !!}3
                            {!! Form::radio('how_often6', 4)  !!}4

                        </td>
                        <td style="width: 85.5333px;">
                            {!! Form::radio('attendance', 'yes')  !!}yes
                            {!! Form::radio('attendance','no' )  !!}no
                        </td>
                        <td style="width: 90.5167px;">
                            {!! Form::radio('attendance', 'yes')  !!}yes
                            {!! Form::radio('attendance','no' )  !!}no
                        </td>
                        <td style="width: 82.7667px;">&nbsp;</td>
                        <td style="width: 93.8833px;">
                            {!! Form::radio('attendance', 'yes')  !!}yes
                            {!! Form::radio('attendance','no' )  !!}no
                        </td>

                    </tr>
                    <tr>
                        <td style="width: 98.0333px;">&nbsp;HIV in children and adolescents&nbsp;</td>
                        <td style="width: 80.8px;">
                            {!! Form::radio('how_often7', 1)  !!}1
                            {!! Form::radio('how_often7', 2)  !!}2
                            {!! Form::radio('how_often7', 3)  !!}3
                            {!! Form::radio('how_often7', 4)  !!}4

                        </td>
                        <td style="width: 85.5333px;">
                            {!! Form::radio('attendance', 'yes')  !!}yes
                            {!! Form::radio('attendance','no' )  !!}no
                        </td>
                        <td style="width: 90.5167px;">
                            {!! Form::radio('attendance', 'yes')  !!}yes
                            {!! Form::radio('attendance','no' )  !!}no
                        </td>
                        <td style="width: 82.7667px;">&nbsp;</td>
                        <td style="width: 93.8833px;">
                            {!! Form::radio('attendance', 'yes')  !!}yes
                            {!! Form::radio('attendance','no' )  !!}no
                        </td>

                    </tr>
                    <tr>
                        <td style="width: 98.0333px;">&nbsp;Growth and development in children and adolescents&nbsp;</td>
                        <td style="width: 80.8px;">
                            {!! Form::radio('how_often8', 1)  !!}1
                            {!! Form::radio('how_often8', 2)  !!}2
                            {!! Form::radio('how_often8', 3)  !!}3
                            {!! Form::radio('how_often8', 4)  !!}4
                        </td>
                        <td style="width: 85.5333px;">
                            {!! Form::radio('attendance', 'yes')  !!}yes
                            {!! Form::radio('attendance','no' )  !!}no
                        </td>
                        <td style="width: 90.5167px;">
                            {!! Form::radio('attendance', 'yes')  !!}yes
                            {!! Form::radio('attendance','no' )  !!}no
                        </td>
                        <td style="width: 82.7667px;">&nbsp;</td>
                        <td style="width: 93.8833px;">
                            {!! Form::radio('attendance', 'yes')  !!}yes
                            {!! Form::radio('attendance','no' )  !!}no
                        </td>

                    </tr>
                    <tr>

                        <td style="width: 98.0333px;">&nbsp;Basic communication&nbsp;</td>
                        <td style="width: 80.8px;">
                            {!! Form::radio('how_often9', 1)  !!}1
                            {!! Form::radio('how_often9', 2)  !!}2
                            {!! Form::radio('how_often9', 3)  !!}3
                            {!! Form::radio('how_often9', 4)  !!}4
                        </td>
                        <td style="width: 85.5333px;">
                            {!! Form::radio('attendance', 'yes')  !!}yes
                            {!! Form::radio('attendance','no' )  !!}no
                        </td>
                        <td style="width: 90.5167px;">
                            {!! Form::radio('attendance', 'yes')  !!}yes
                            {!! Form::radio('attendance','no' )  !!}no
                        </td>
                        <td style="width: 82.7667px;">&nbsp;</td>
                        <td style="width: 93.8833px;">
                            {!! Form::radio('attendance', 'yes')  !!}yes
                            {!! Form::radio('attendance','no' )  !!}no
                        </td>

                    </tr>
                    <tr>
                        <td style="width: 98.0333px;">&nbsp;Communication in children and adolescents&nbsp;</td>
                        <td style="width: 80.8px;">
                            {!! Form::radio('how_often10', 1)  !!}1
                            {!! Form::radio('how_often10', 2)  !!}2
                            {!! Form::radio('how_often10', 3)  !!}3
                            {!! Form::radio('how_often10', 4)  !!}4
                        </td>
                        <td style="width: 85.5333px;">
                            {!! Form::radio('attendance', 'yes')  !!}yes
                            {!! Form::radio('attendance','no' )  !!}no
                        </td>
                        <td style="width: 90.5167px;">
                            {!! Form::radio('attendance', 'yes')  !!}yes
                            {!! Form::radio('attendance','no' )  !!}no
                        </td>
                        <td style="width: 82.7667px;">&nbsp;</td>
                        <td style="width: 93.8833px;">
                            {!! Form::radio('attendance', 'yes')  !!}yes
                            {!! Form::radio('attendance','no' )  !!}no
                        </td>

                    </tr>
                    <tr>
                        <td style="width: 98.0333px;">&nbsp;Introduction to theory and practice in counselling&nbsp;</td>
                        <td style="width: 80.8px;">
                            {!! Form::radio('how_often11', 1)  !!}1
                            {!! Form::radio('how_often11', 2)  !!}2
                            {!! Form::radio('how_often11', 3)  !!}3
                            {!! Form::radio('how_often11', 4)  !!}4
                        </td>
                        <td style="width: 85.5333px;">
                            {!! Form::radio('attendance', 'yes')  !!}yes
                            {!! Form::radio('attendance','no' )  !!}no
                        </td>
                        <td style="width: 90.5167px;">
                            {!! Form::radio('attendance', 'yes')  !!}yes
                            {!! Form::radio('attendance','no' )  !!}no
                        </td>

                        <td style="width: 93.8833px;">&nbsp;</td>
                        <td style="width: 82.7667px;">
                            {!! Form::radio('attendance', 'yes')  !!}yes
                            {!! Form::radio('attendance','no' )  !!}no
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 98.0333px;">Use play as a medium of communication with children and adolescents for therapeutic support</td>
                        <td style="width: 80.8px;">
                            {!! Form::radio('how_often12', 1)  !!}1
                            {!! Form::radio('how_often12', 2)  !!}2
                            {!! Form::radio('how_often12', 3)  !!}3
                            {!! Form::radio('how_often12', 4)  !!}4
                        </td>
                        <td style="width: 85.5333px;">
                            {!! Form::radio('attendance', 'yes')  !!}yes
                            {!! Form::radio('attendance','no' )  !!}no
                        </td>
                        <td style="width: 90.5167px;">
                            {!! Form::radio('attendance', 'yes')  !!}yes
                            {!! Form::radio('attendance','no' )  !!}no
                        </td>
                        <td style="width: 82.7667px;">&nbsp;</td>
                        <td style="width: 93.8833px;">
                            {!! Form::radio('attendance', 'yes')  !!}yes
                            {!! Form::radio('attendance','no' )  !!}no
                        </td>

                    </tr>
                    <tr>
                        <td style="width: 98.0333px;">Counselling children infected and affected by HIV</td>
                        <td style="width: 80.8px;">
                            {!! Form::radio('how_often13', 1)  !!}1
                            {!! Form::radio('how_often13', 2)  !!}2
                            {!! Form::radio('how_often13', 3)  !!}3
                            {!! Form::radio('how_often13', 4)  !!}4
                        </td>

                        <td style="width: 82.7667px;">
                            {!! Form::radio('attendance', 'yes')  !!}yes
                            {!! Form::radio('attendance','no' )  !!}no
                        </td>

                        <td style="width: 90.5167px;">
                            {!! Form::radio('attendance', 'yes')  !!}yes
                            {!! Form::radio('attendance','no' )  !!}no

                        </td>
                        <td style="width: 82.7667px;">&nbsp;</td>
                        <td style="width: 93.8833px;">
                            {!! Form::radio('attendance', 'yes')  !!}yes
                            {!! Form::radio('attendance','no' )  !!}no
                        </td>

                    </tr>
                    <tr>
                        <td style="width: 98.0333px;">Counseling adolescents infected and affected by HIV&nbsp;</td>
                        <td style="width: 80.8px;">
                            {!! Form::radio('how_often14', 1)  !!}1
                            {!! Form::radio('how_often14', 2)  !!}2
                            {!! Form::radio('how_often14', 3)  !!}3
                            {!! Form::radio('how_often14', 4)  !!}4
                        </td>
                        <td style="width: 85.5333px;">
                            {!! Form::radio('attendance', 'yes')  !!}yes
                            {!! Form::radio('attendance','no' )  !!}no
                        </td>
                        <td style="width: 90.5167px;">
                            {!! Form::radio('attendance', 'yes')  !!}yes
                            {!! Form::radio('attendance','no' )  !!}no
                        </td>
                        <td style="width: 82.7667px;">&nbsp;</td>

                        <td style="width: 94.86667px;">
                            {!! Form::radio('attendance', 'yes')  !!}yes
                            {!! Form::radio('attendance','no' )  !!}no
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 98.0333px;">Sexual and Reproductive health in children and adolescents</td>
                        <td style="width: 80.8px;">
                            {!! Form::radio('how_often15', 1)  !!}1
                            {!! Form::radio('how_often15', 2)  !!}2
                            {!! Form::radio('how_often15', 3)  !!}3
                            {!! Form::radio('how_often15', 4)  !!}4
                        </td>
                        <td style="width: 85.5333px;">
                            {!! Form::radio('attendance15', 'yes')  !!}yes
                            {!! Form::radio('attendance15','no' )  !!}no
                        </td>
                        <td style="width: 90.5167px;">
                            {!! Form::radio('attendance', 'yes')  !!}yes
                            {!! Form::radio('attendance','no' )  !!}no
                        </td>


                        <td style="width: 93.8833px;">&nbsp;</td>
                        <td style="width: 82.7667px;">
                            {!! Form::radio('attendance', 'yes')  !!}yes
                            {!! Form::radio('attendance','no' )  !!}no
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 98.0333px;">Child and adolescent friendly support services</td>
                        <td style="width: 80.8px;">
                            {!! Form::radio('how_often16', 1)  !!}1
                            {!! Form::radio('how_often16', 2)  !!}2
                            {!! Form::radio('how_often16', 3)  !!}3
                            {!! Form::radio('how_often16', 4)  !!}4
                        </td>
                        <td style="width: 85.5333px;">
                            {!! Form::radio('attendance16', 'yes')  !!}yes
                            {!! Form::radio('attendance16','no' )  !!}no
                        </td>
                        <td style="width: 90.5167px;">
                            {!! Form::radio('attendance', 'yes')  !!}yes
                            {!! Form::radio('attendance','no' )  !!}no
                        </td>
                        <td style="width: 82.7667px;">&nbsp;</td>
                        <td style="width: 93.8833px;">
                            {!! Form::radio('attendance', 'yes')  !!}yes
                            {!! Form::radio('attendance','no' )  !!}no
                        </td>

                    </tr>
                    <tr>
                        <td style="width: 98.0333px;">Mental health services for pediatrics and adolescents ( Depression, anxiety disorders)</td>
                        <td style="width: 80.8px;">
                            {!! Form::radio('how_often17', 1)  !!}1
                            {!! Form::radio('how_often17', 2)  !!}2
                            {!! Form::radio('how_often17', 3)  !!}3
                            {!! Form::radio('how_often17', 4)  !!}4
                        </td>
                        <td style="width: 85.5333px;">
                            {!! Form::radio('attendance17', 'yes')  !!}yes
                            {!! Form::radio('attendance17','no' )  !!}no
                        </td>
                        <td style="width: 90.5167px;">
                            {!! Form::radio('attendance', 'yes')  !!}yes
                            {!! Form::radio('attendance','no' )  !!}no
                        </td>
                        <td style="width: 82.7667px;">&nbsp;</td>
                        <td style="width: 93.8833px;">
                            {!! Form::radio('attendance', 'yes')  !!}yes
                            {!! Form::radio('attendance','no' )  !!}no
                        </td>

                    </tr>
                    <tr>
                        <td style="width: 98.0333px;">Managing Substance Abuse among adolescents (including drugs and Alcohol)</td>
                        <td style="width: 80.8px;">
                            {!! Form::radio('how_often18', 1)  !!}1
                            {!! Form::radio('how_often18', 2)  !!}2
                            {!! Form::radio('how_often18', 3)  !!}3
                            {!! Form::radio('how_often18', 4)  !!}4
                        </td>
                        <td style="width: 85.5333px;">
                            {!! Form::radio('attendance', 'yes')  !!}yes
                            {!! Form::radio('attendance','no' )  !!}no
                        </td>
                        <td style="width: 90.5167px;">
                            {!! Form::radio('attendance', 'yes')  !!}yes
                            {!! Form::radio('attendance','no' )  !!}no
                        </td>
                        <td style="width: 82.7667px;">

                        </td>
                        <td style="width: 93.8833px;">
                            {!! Form::radio('attendance', 'yes')  !!}yes
                            {!! Form::radio('attendance','no' )  !!}no
                        </td>

                    </tr>
                    </tbody>
                </table>
                <!-- DivTable.com -->
                <p>&nbsp;</p>
            </div>
            <h4><strong>C: Key Challenges and Recommendations:</strong> List key challenges and suggestions for training in Paediatric and Adolescent care</h4>

<div class="row">
    <div class="col-xs-6">
        {!! Form::label('challenges', 'Challenges:') !!}
        {!! Form::textarea('challenges',old('challenges'), ['class' => 'form-control', 'placeholder' => '']) !!}
    </div>
    <div class="col-xs-6">
        {!! Form::label('recommendation', 'Recommendation:') !!}
        {!! Form::textarea('recommendation',old('recommendation'), ['class' => 'form-control', 'placeholder' => '']) !!}
    </div>



</div>


            <div class="row">
                {!! Form::submit('Save feedback', ['class' => 'btn btn-danger ']) !!}


            </div>


            {!! Form::close() !!}

        </div>

    </div>


    @stop