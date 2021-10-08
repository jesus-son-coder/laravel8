<x-layout>
    <section class="px-6 py-8">
        <!--<main class="max-w-lg mx-auto mt-10 bg-gray-100 p-6 border-gray-200 rounded-xl">-->

             <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Profil</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                <li class="breadcrumb-item active">Profil utilisateur</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container">
          <div class="row">
            <div class="col-md-3">

              <!-- Profile Image -->
              <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                  <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="/images/user4-128x128.jpg" alt="User profile picture">
                    <!-- Mode dynamique : -->
                    <!--<img class="profile-user-img img-fluid img-circle" src="{{ Auth::user()->picture }}" alt="User profile picture">-->
                  </div>

                  <h3 class="profile-username text-center">{{ Auth::user()->name}}</h3>

                  <p class="text-muted text-center">Software Engineer</p>

                  <p class="text-center mt-3" style="font-size:12px;"><a href="#" class="">Modifier votre image de profil</a></p>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->

              <!-- About Me Box -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">A propos de moi</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <strong><i class="fas fa-book mr-1"></i> Présentation</strong>

                  <p class="text-muted mb-3">
                    Lorem ipsum represents a long-held tradition for designers, typographers and the like. Some people hate it and argue for its demise.
                  </p>
                  <hr>

                  <strong><i class="fas fa-map-marker-alt mr-1 mt-3"></i> Expériences Voyages</strong>
                  <p class="text-muted mb-3">Malibu, California, Italie, Venise</p>
                  <hr>

                  <strong><i class="fas fa-utensils mr-1 mt-3"></i> Passions Culinaires</strong>
                  <p class="text-muted mb-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
              <div class="card">
                <div class="card-header p-2">
                  <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#personal_info" data-toggle="tab">Informations personnelles</a></li>
                    <li class="nav-item"><a class="nav-link" href="#change_password" data-toggle="tab">Changer le Mot de passe</a></li>
                    <!--<li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>-->
                  </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane" id="personal_info">
                      <form class="form-horizontal">
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">Nom</label>
                          <div class="col-sm-10">
                            <input type="email" class="form-control" id="inputName" placeholder="Nom" value="{{ Auth::user()->name}}">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                          <div class="col-sm-10">
                            <input type="email" class="form-control" id="inputEmail" placeholder="Email" value="{{ Auth::user()->email}}">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputName2" class="col-sm-2 col-form-label">Username</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputName2" placeholder="username" value="{{ Auth::user()->username}}">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputExperience" class="col-sm-2 col-form-label">Expériences Voyages</label>
                          <div class="col-sm-10">
                            <textarea class="form-control" id="inputExperience" placeholder="expériences..."></textarea>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputSkills" class="col-sm-2 col-form-label">Passions culinaires</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputSkills" placeholder="passions...">
                          </div>
                        </div>
                        <!--
                        <div class="form-group row">
                          <div class="offset-sm-2 col-sm-10">
                            <div class="checkbox">
                              <label>
                                <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                              </label>
                            </div>
                          </div>
                        </div>
                        -->

                        <div class="form-group row">
                          <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn button-profile">Enregistrer les modifications</button>
                          </div>
                        </div>
                      </form>
                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane" id="change_password">
                        <form class="form-horizontal">
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Ancien Mot de passe</label>
                            <div class="col-sm-10">
                              <input type="email" class="form-control" id="oldpassword" placeholder="Saisir votre mot de passe actuel">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputEmail" class="col-sm-2 col-form-label">Nouveau Mot de passe</label>
                            <div class="col-sm-10">
                              <input type="email" class="form-control" id="newpassword" placeholder="Saisir le nouveau mot de passe">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName2" class="col-sm-2 col-form-label">Confirmer le Mot de passe</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="cnewpassword" placeholder="Ressaisir le mot de passe">
                            </div>
                          </div>

                          <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                              <button type="submit" class="btn button-profile">Modifier le Mot de passe</button>
                            </div>
                          </div>
                        </form>
                      </div>
                      <!-- /.tab-pane -->
                  </div>
                  <!-- /.tab-content -->
                </div><!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->


        <!--</main>-->
    </section>
</x-layout>
