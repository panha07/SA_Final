@extends('frontend.layout.master')
@section('pg_createCV', 'active')
@section('content')
<div id="app">
    <template>
        <div class="container py-5">
          <div class="row">
            <!-- Input Form -->
            <div class="col-md-6">
              <div class="form-container bg-light p-4 rounded shadow-sm">
                <h3 class="text-center fw-bold mb-4">Build Your CV</h3>
                <form @submit.prevent="submitForm">
                  <!-- Profile Picture -->
                  <div class="mb-3">
                    <label for="profilePicture" class="form-label">Profile Picture</label>
                    <input type="file" class="form-control" id="profilePicture" @change="previewImage" accept="image/*">
                  </div>
      
                  <!-- Personal Information -->
                  <div class="mb-3">
                    <label for="fullName" class="form-label">Full Name</label>
                    <input type="text" class="form-control" v-model="form.fullName" placeholder="John Doe">
                  </div>
                  <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" v-model="form.phone" placeholder="123-456-7890">
                  </div>
                  <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" v-model="form.email" placeholder="example@gmail.com">
                  </div>
                  <div class="mb-3">
                    <label for="applyFor" class="form-label">Apply For</label>
                    <input type="text" class="form-control" v-model="form.applyFor" placeholder="Position">
                  </div>
                  <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" v-model="form.address" placeholder="Phnom Penh">
                  </div>
      
                  <div class="row mb-3">
                    <!-- Nationality -->
                    <div class="col-md-6">
                      <label for="nationality" class="form-label">Nationality</label>
                      <input type="text" class="form-control" v-model="form.nationality" placeholder="Nationality">
                    </div>
      
                    <!-- Gender -->
                    <div class="col-md-6">
                      <label class="form-label">Gender</label>
                      <div>
                        <input type="radio" id="male" value="Male" v-model="form.gender">
                        <label for="male">Male</label>
                        <input type="radio" id="female" value="Female" v-model="form.gender">
                        <label for="female">Female</label>
                      </div>
                    </div>
                  </div>
      
                  <div class="row mb-3">
                    <!-- Date of Birth -->
                    <div class="col-md-3">
                      <label for="dateOfBirth" class="form-label">Date of Birth</label>
                      <input type="date" class="form-control" v-model="form.dateOfBirth">
                    </div>
      
                    <!-- Marital Status -->
                    <div class="col-md-3">
                      <label for="maritalStatus" class="form-label">Marital Status</label>
                      <select class="form-control" v-model="form.maritalStatus">
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                        <option value="Divorced">Divorced</option>
                      </select>
                    </div>
      
                    <!-- Height -->
                    <div class="col-md-3">
                      <label for="height" class="form-label">Height</label>
                      <input type="text" class="form-control" v-model="form.height" placeholder="e.g., 170 cm">
                    </div>
      
                    <!-- Health -->
                    <div class="col-md-3">
                      <label for="health" class="form-label">Health</label>
                      <input type="text" class="form-control" v-model="form.health" placeholder="e.g., Good">
                    </div>
                  </div>
      
                  <!-- Place of Birth -->
                  <div class="mb-3">
                    <label for="placeOfBirth" class="form-label">Place of Birth</label>
                    <input type="text" class="form-control" v-model="form.placeOfBirth" placeholder="City, Country">
                  </div>
      
                  <!-- Education -->
                  <div id="education-section" class="mb-3">
                    <label class="form-label">Education</label>
                    <div v-for="(education, index) in form.education" :key="index" class="education-entry mb-2">
                      <div class="row g-2 align-items-center mb-2">
                        <div class="col-md-6">
                          <input type="text" class="form-control mb-2" v-model="education.schoolName" placeholder="School Name">
                        </div>
                        <div class="col-md-6">
                          <input type="text" class="form-control mb-2" v-model="education.subject" placeholder="Subject">
                        </div>
                      </div>
                      <div class="d-flex">
                        <input type="number" class="form-control me-2" v-model="education.startYear" placeholder="Start Year">
                        <input type="number" class="form-control" v-model="education.endYear" placeholder="End Year">
                      </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-primary mt-2" @click="addEducation">+ Add Education</button>
                  </div>
      
                  <!-- Experience -->
                  <div id="experience-section" class="mb-3">
                    <label class="form-label">Experience</label>
                    <div v-for="(experience, index) in form.experience" :key="index" class="experience-entry mb-2">
                      <div class="row g-2 align-items-center mb-2">
                        <div class="col-md-6">
                          <input type="text" class="form-control" v-model="experience.companyName" placeholder="Company Name">
                        </div>
                        <div class="col-md-6">
                          <input type="text" class="form-control" v-model="experience.position" placeholder="Position">
                        </div>
                      </div>
                      <div class="row g-2 align-items-center">
                        <div class="col-md-6">
                          <input type="number" class="form-control" v-model="experience.startYear" placeholder="Start Year">
                        </div>
                        <div class="col-md-6">
                          <input type="number" class="form-control" v-model="experience.endYear" placeholder="End Year">
                        </div>
                      </div>
                      <button type="button" class="btn btn-sm btn-danger" @click="removeExperience(index)">Remove</button>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-primary mt-2" @click="addExperience">+ Add Experience</button>
                  </div>
      
                  <!-- Skills -->
                  <div id="skills-section" class="mb-3">
                    <label class="form-label">Skills</label>
                    <div v-for="(skill, index) in form.skills" :key="index" class="skills-entry mb-2">
                      <div class="row g-2 align-items-center mb-2">
                        <div class="col-md-6">
                          <input type="text" class="form-control" v-model="skill.name" placeholder="Skill Name">
                        </div>
                        <div class="col-md-6">
                          <select class="form-control" v-model="skill.level">
                            <option value="Beginner">Beginner</option>
                            <option value="Intermediate">Intermediate</option>
                            <option value="Expert">Expert</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-primary" @click="addSkill">+ Add Skill</button>
                  </div>
      
                  <!-- Language -->
                  <div id="language-section" class="mb-3">
                    <label class="form-label">Language</label>
                    <div v-for="(language, index) in form.languages" :key="index" class="language-entry mb-2">
                      <div class="row g-2 align-items-center mb-2">
                        <div class="col-md-6">
                          <input type="text" class="form-control" v-model="language.name" placeholder="Language">
                        </div>
                        <div class="col-md-6">
                          <select class="form-control" v-model="language.proficiency">
                            <option value="Beginner">Beginner</option>
                            <option value="Intermediate">Intermediate</option>
                            <option value="Fluent">Fluent</option>
                            <option value="Native">Native</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-primary" @click="addLanguage">+ Add Language</button>
                  </div>
      
                  <!-- References -->
                  <div id="references-section" class="mb-3">
                    <label class="form-label">References</label>
                    <div v-for="(reference, index) in form.references" :key="index" class="reference-entry mb-2">
                      <div class="row g-2 align-items-center mb-2">
                        <div class="col-md-4">
                          <input type="text" class="form-control" v-model="reference.name" placeholder="Reference Name">
                        </div>
                        <div class="col-md-4">
                          <input type="text" class="form-control" v-model="reference.position" placeholder="Position">
                        </div>
                        <div class="col-md-4">
                          <input type="text" class="form-control" v-model="reference.contact" placeholder="Contact Number">
                        </div>
                      </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-primary" @click="addReference">+ Add Reference</button>
                  </div>
      
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
            </div>
      
            <!-- CV Preview Section -->
            <div class="col-md-6">
              <div class="preview-container bg-white p-4 rounded shadow-sm">
                <h3 class="text-center fw-bold mb-4">Curriculum Vitae</h3>
                <div id="cvPreview" class="cv-preview">
                  <div class="container mt-4">
                    <div class="row align-items-center">
                      <!-- Left Section: Text Information -->
                      <div class="col-md-8 text-section">
                        <p id="previewFullName" class="text-left">{{ form.fullName }}</p>
                        <p id="previewApplyFor" class="text-left">{{ form.applyFor }}</p>
                        <p id="previewAddress" class="text-left">{{ form.address }}</p>
                        <p id="previewPhone" class="text-left">{{ form.phone }}</p>
                        <p id="previewEmail" class="text-left">{{ form.email }}</p>
                      </div>
      
                      <!-- Right Section: Profile Picture -->
                      <div class="col-md-4 text-center photo-section">
                        <img :src="imagePreview" alt="Profile Picture" class="img-thumbnail" style="max-width: 150px;" v-if="imagePreview">
                      </div>
                    </div>
                  </div>
                  <hr>
      
                  <div class="mb-4">
                    <div class="bg-primary p-2">
                      <h5 class="text-primary text-white">PERSONAL DETAILS</h5>
                    </div>
                    <div class="col-md-9">
                      <p><strong>Name:</strong> {{ form.fullName }}</p>
                      <p><strong>Gender:</strong> {{ form.gender }}</p>
                      <p><strong>Nationality:</strong> {{ form.nationality }}</p>
                      <p><strong>Date Of Birth:</strong> {{ form.dateOfBirth }}</p>
                      <p><strong>Place of Birth:</strong> {{ form.placeOfBirth }}</p>
                      <p><strong>Marital Status:</strong> {{ form.maritalStatus }}</p>
                      <p><strong>Height:</strong> {{ form.height }}</p>
                      <p><strong>Health:</strong> {{ form.health }}</p>
                    </div>
                  </div>
      
                  <div class="mb-4">
                    <div class="bg-primary p-2">
                      <h5 class="text-primary text-white">EDUCATIONAL BACKGROUND</h5>
                    </div>
                    <ul>
                      <li v-for="(education, index) in form.education" :key="index">
                        ({{ education.startYear }} - {{ education.endYear }}): <strong>{{ education.schoolName }}</strong> ({{ education.subject }})
                      </li>
                    </ul>
                  </div>
      
                  <div class="mb-4">
                    <div class="bg-primary p-2">
                      <h5 class="text-primary text-white">JOB EXPERIENCE</h5>
                    </div>
                    <ul>
                      <li v-for="(experience, index) in form.experience" :key="index">
                        ({{ experience.startYear }} - {{ experience.endYear }}): <strong>{{ experience.position }}</strong> at {{ experience.companyName }}
                      </li>
                    </ul>
                  </div>
      
                  <div class="mb-4">
                    <div class="bg-primary p-2">
                      <h5 class="text-primary text-white">SKILLS</h5>
                    </div>
                    <ul>
                      <li v-for="(skill, index) in form.skills" :key="index">
                        <strong>{{ skill.name }}</strong> ({{ skill.level }})
                      </li>
                    </ul>
                  </div>
      
                  <div class="mb-4">
                    <div class="bg-primary p-2">
                      <h5 class="text-primary text-white">LANGUAGE</h5>
                    </div>
                    <ul>
                      <li v-for="(language, index) in form.languages" :key="index">
                        <strong>{{ language.name }}</strong> ({{ language.proficiency }})
                      </li>
                    </ul>
                  </div>
      
                  <div class="mb-4">
                    <div class="bg-primary p-2">
                      <h5 class="text-primary text-white">REFERENCES</h5>
                    </div>
                    <ul>
                      <li v-for="(reference, index) in form.references" :key="index">
                        <strong>{{ reference.name }}</strong> ({{ reference.position }}) - {{ reference.contact }}
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </template>
      
      <script>
      export default {
        data() {
          return {
            form: {
              fullName: '',
              phone: '',
              email: '',
              applyFor: '',
              address: '',
              nationality: '',
              gender: '',
              dateOfBirth: '',
              maritalStatus: '',
              height: '',
              health: '',
              placeOfBirth: '',
              education: [{ schoolName: '', subject: '', startYear: '', endYear: '' }],
              experience: [{ companyName: '', position: '', startYear: '', endYear: '' }],
              skills: [{ name: '', level: 'Beginner' }],
              languages: [{ name: '', proficiency: 'Beginner' }],
              references: [{ name: '', position: '', contact: '' }]
            },
            imagePreview: null
          };
        },
        methods: {
          previewImage(event) {
            const file = event.target.files[0];
            if (file) {
              const reader = new FileReader();
              reader.onload = (e) => {
                this.imagePreview = e.target.result;
              };
              reader.readAsDataURL(file);
            }
          },
          addEducation() {
            this.form.education.push({ schoolName: '', subject: '', startYear: '', endYear: '' });
          },
          addExperience() {
            this.form.experience.push({ companyName: '', position: '', startYear: '', endYear: '' });
          },
          removeExperience(index) {
            this.form.experience.splice(index, 1);
          },
          addSkill() {
            this.form.skills.push({ name: '', level: 'Beginner' });
          },
          addLanguage() {
            this.form.languages.push({ name: '', proficiency: 'Beginner' });
          },
          addReference() {
            this.form.references.push({ name: '', position: '', contact: '' });
          },
          submitForm() {
            // Handle form submission
            console.log(this.form);
          }
        }
      };
      </script>
      
      <style scoped>
      /* Add your styles here */
      </style>
</div>
 
@endsection
