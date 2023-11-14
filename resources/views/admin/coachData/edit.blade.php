@extends(Auth::user()->hasRole('admin') ? 'admin.layouts.master' : 'coach.layouts.master')

@section('main-content')
    <div class="container">
        <h1>Edit Conference Record</h1>
        <form action="{{ route('data.update', $conference->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">

                <!-- Conference Field -->
                <div class="form-group col-4">
                    <label for="conference">Conference</label>
                    <input type="text" class="form-control" id="conference" name="conference"
                        value="{{ $conference->conference }}">
                </div>

                <!-- State Field -->
                <div class="form-group col-4">
                    <label for="state">State</label>
                    <input type="text" class="form-control" id="state" name="state"
                        value="{{ $conference->state }}">
                </div>

                <!-- Division Field -->
                <div class="form-group col-4">
                    <label for="division">Division</label>
                    <input type="text" class="form-control" id="division" name="division"
                        value="{{ $conference->division }}">
                </div>

                <!-- Unique_ID Field -->
                <div class="form-group col-4">
                    <label for="unique_id">Unique ID</label>
                    <input type="text" class="form-control" id="unique_id" name="unique_id"
                        value="{{ $conference->unique_id }}">
                </div>

                <!-- Sport_code Field -->
                <div class="form-group col-4">
                    <label for="sport_code">Sport Code</label>
                    <input type="text" class="form-control" id="sport_code" name="sport_code"
                        value="{{ $conference->sport_code }}">
                </div>

                <!-- Added Field -->
                <div class="form-group col-4">
                    <label for="added">Added</label>
                    <input type="text" class="form-control" id="added" name="added"
                        value="{{ $conference->added }}">
                </div>
                <!-- Removed Field -->
                <div class="form-group col-4">
                    <label for="removed">Removed</label>
                    <input type="text" class="form-control" id="removed" name="removed"
                        value="{{ $conference->removed }}">
                </div>

                <!-- School Field -->
                <div class="form-group col-4">
                    <label for="school">School</label>
                    <input type="text" class="form-control" id="school" name="school"
                        value="{{ $conference->school }}">
                </div>

                <!-- First_name Field -->
                <div class="form-group col-4">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name"
                        value="{{ $conference->first_name }}">
                </div>

                <!-- Last_name Field -->
                <div class="form-group col-4">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name"
                        value="{{ $conference->last_name }}">
                </div>

                <!-- Position Field -->
                <div class="form-group col-4">
                    <label for="position">Position</label>
                    <input type="text" class="form-control" id="position" name="position"
                        value="{{ $conference->position }}">
                </div>

                <!-- Email_address Field -->
                <div class="form-group col-4">
                    <label for="email_address">Email Address</label>
                    <input type="email" class="form-control" id="email_address" name="email_address"
                        value="{{ $conference->email_address }}">
                </div>

                <!-- Phone_number Field -->
                <div class="form-group col-4">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number"
                        value="{{ $conference->phone_number }}">
                </div>

                <!-- Add more fields for the remaining data -->

                <!-- Landing_pages Field -->
                <div class="form-group col-4">
                    <label for="landing_pages">Landing Pages</label>
                    <input type="text" class="form-control" id="landing_pages" name="landing_pages"
                        value="{{ $conference->landing_pages }}">
                </div>

                <!-- IndividualTwitter Field -->
                <div class="form-group col-4">
                    <label for="individual_twitter">Individual Twitter</label>
                    <input type="text" class="form-control" id="individual_twitter" name="individual_twitter"
                        value="{{ $conference->individual_twitter }}">
                </div>

                <!-- TeamTwitter Field -->
                <div class="form-group col-4">
                    <label for="team_twitter">Team Twitter</label>
                    <input type="text" class="form-control" id="team_twitter" name="team_twitter"
                        value="{{ $conference->team_twitter }}">
                </div>

                <!-- Add more fields for the remaining data -->

                <!-- IndividualFacebook Field -->
                <div class="form-group col-4">
                    <label for="individual_facebook">Individual Facebook</label>
                    <input type="text" class="form-control" id="individual_facebook" name="individual_facebook"
                        value="{{ $conference->individual_facebook }}">
                </div>

                <!-- TeamFacebook Field -->
                <div class="form-group col-4">
                    <label for="team_facebook">Team Facebook</label>
                    <input type="text" class="form-control" id="team_facebook" name="team_facebook"
                        value="{{ $conference->team_facebook }}">
                </div>

                <!-- IndividualInstagram Field -->
                <div class="form-group col-4">
                    <label for="individual_instagram">Individual Instagram</label>
                    <input type="text" class="form-control" id="individual_instagram" name="individual_instagram"
                        value="{{ $conference->individual_instagram }}">
                </div>

                <!-- TeamInstagram Field -->
                <div class="form-group col-4">
                    <label for="team_instagram">Team Instagram</label>
                    <input type="text" class="form-control" id="team_instagram" name="team_instagram"
                        value="{{ $conference->team_instagram }}">
                </div>

                <!-- Add more fields for the remaining data -->

                <!-- Questionnaire Field -->
                <div class="form-group col-4">
                    <label for="questionnaire">Questionnaire</label>
                    <input type="text" class="form-control" id="questionnaire" name="questionnaire"
                        value="{{ $conference->questionnaire }}">
                </div>

                <!-- School2 Field -->
                <div class="form-group col-4">
                    <label for="school2">School 2</label>
                    <input type="text" class="form-control" id="school2" name="school2"
                        value="{{ $conference->school2 }}">
                </div>

                <!-- State2 Field -->
                <div class="form-group col-4">
                    <label for="state2">State 2</label>
                    <input type="text" class="form-control" id="state2" name="state2"
                        value="{{ $conference->state2 }}">
                </div>

                <!-- City Field -->
                <div class="form-group col-4">
                    <label for="city">City</label>
                    <input type="text" class="form-control" id="city" name="city"
                        value="{{ $conference->city }}">
                </div>

                <!-- Add more fields for the remaining data -->

                <!-- Region Field -->
                <div class="form-group col-4">
                    <label for="region">Region</label>
                    <input type="text" class="form-control" id="region" name="region"
                        value="{{ $conference->region }}">
                </div>

                <!-- Sizeofcity Field -->
                <div class="form-group col-4">
                    <label for="sizeofcity">Size of City</label>
                    <input type="text" class="form-control" id="sizeofcity" name="sizeofcity"
                        value="{{ $conference->sizeofcity }}">
                </div>

                <!-- Private/Public Field -->
                <div class="form-group col-4">
                    <label for="private_public">Private/Public</label>
                    <input type="text" class="form-control" id="private_public" name="private_public"
                        value="{{ $conference->private_public }}">
                </div>

                <!-- Religiousaffiliation Field -->
                <div class="form-group col-4">
                    <label for="religiousaffiliation">Religious Affiliation</label>
                    <input type="text" class="form-control" id="religiousaffiliation" name="religiousaffiliation"
                        value="{{ $conference->religiousaffiliation }}">
                </div>

                <!-- Add more fields for the remaining data -->

                <!-- HBCU Field -->
                <div class="form-group col-4">
                    <label for="hbcu">HBCU</label>
                    <input type="text" class="form-control" id="hbcu" name="hbcu"
                        value="{{ $conference->hbcu }}">
                </div>

                <!-- AverageGPA Field -->
                <div class="form-group col-4">
                    <label for="average_gpa">Average GPA</label>
                    <input type="text" class="form-control" id="average_gpa" name="average_gpa"
                        value="{{ $conference->average_gpa }}">
                </div>

                <!-- SAT-Reading Field -->
                <div class="form-group col-4">
                    <label for="sat_reading">SAT Reading</label>
                    <input type="text" class="form-control" id="sat_reading" name="sat_reading"
                        value="{{ $conference->sat_reading }}">
                </div>

                <!-- SAT-Math Field -->
                <div class="form-group col-4">
                    <label for="sat_math">SAT Math</label>
                    <input type="text" class="form-control" id="sat_math" name="sat_math"
                        value="{{ $conference->sat_math }}">
                </div>

                <!-- ACTcomposite Field -->
                <div class="form-group col-4">
                    <label for="act_composite">ACT Composite</label>
                    <input type="text" class="form-control" id="act_composite" name="act_composite"
                        value="{{ $conference->act_composite }}">
                </div>

                <!-- Acceptancerate Field -->
                <div class="form-group col-4">
                    <label for="acceptance_rate">Acceptance Rate</label>
                    <input type="text" class="form-control" id="acceptance_rate" name="acceptance_rate"
                        value="{{ $conference->acceptance_rate }}">
                </div>

                <!-- Totalyearlycost Field -->
                <div class="form-group col-4">
                    <label for="total_yearly_cost">Total Yearly Cost</label>
                    <input type="text" class="form-control" id="total_yearly_cost" name="total_yearly_cost"
                        value="{{ $conference->total_yearly_cost }}">
                </div>

                <!-- School3 Field -->
                <div class="form-group col-4">
                    <label for="school3">School 3</label>
                    <input type="text" class="form-control" id="school3" name="school3"
                        value="{{ $conference->school3 }}">
                </div>

                <!-- Majorsoffered Field -->
                <div class="form-group col-4">
                    <label for="majors_offered">Majors Offered</label>
                    <input type="text" class="form-control" id="majors_offered" name="majors_offered"
                        value="{{ $conference->majors_offered }}">
                </div>

                <!-- Noofundergrads Field -->
                <div class="form-group col-4">
                    <label for="no_of_undergrads">Number of Undergrads</label>
                    <input type="text" class="form-control" id="no_of_undergrads" name="no_of_undergrads"
                        value="{{ $conference->no_of_undergrads }}">
                </div>

                <!-- USNews Field -->
                <div class="form-group col-4">
                    <label for="us_news">US News</label>
                    <input type="text" class="form-control" id="us_news" name="us_news"
                        value="{{ $conference->us_news }}">
                </div>

                <!-- IPEDS/NCESID Field -->
                <div class="form-group col-4">
                    <label for="iped_nces_id">IPEDS/NCES ID</label>
                    <input type="text" class="form-control" id="iped_nces_id" name="iped_nces_id"
                        value="{{ $conference->iped_nces_id }}">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
