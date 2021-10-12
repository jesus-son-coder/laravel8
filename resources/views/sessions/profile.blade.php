<x-layout>
    <section class="px-6 py-8">
        <!--<main class="max-w-lg mx-auto mt-10 bg-gray-100 p-6 border-gray-200 rounded-xl">-->

             <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Vos infos personnelles</h1>
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
                    <!--<img class="profile-user-img img-fluid img-circle" src="/images/user4-128x128.jpg" alt="User profile picture">-->
                    <!-- Mode dynamique : -->
                    <img class="profile-user-img img-fluid img-circle user_profile_picture" src="{{ Auth::user()->picture }}" alt="User profile picture">
                  </div>

                  <h3 class="profile-username text-center user_name">{{ Auth::user()->name}}</h3>

                  <p class="text-muted text-center user_short_description">{{ Auth::user()->short_description}}</p>

                  <input type="file" name="user_picture" id="user_picture" style="opacity:0; height:1px; display:none;">
                  <p class="text-center mt-3" style="font-size:12px;"><a href="javascript:void(0)" id="change_picture_btn" class="">Modifier votre image de profil</a></p>
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

                  <p class="text-muted mb-3 userPresentation">
                    {{ Auth::user()->presentation}}
                  </p>
                  <hr>

                  <strong><i class="fas fa-map-marker-alt mr-1 mt-3"></i> Expériences Voyages</strong>
                  <p class="text-muted mb-3 experience_voyage">{{ Auth::user()->voyage}}</p>
                  <hr>

                  <strong><i class="fas fa-utensils mr-1 mt-3 "></i> Passions Culinaires</strong>
                  <p class="text-muted mb-3 userPassion">{{ Auth::user()->culinaire}}</p>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->

              {{--
              @if (session()->has('success'))
                <div x-data="{ show: true }"
                    x-init="setTimeout(() => show = false, 3000)"
                    x-show="show"

                    class="fixed bg-blue-500 text-white py-2 px-4 rounded-xl bottom-3 right-3 text-sm"
                >
                    <p>{{ session('success') }}</p>
                </div>
            @endif
             --}}

            <div class="notification-update text-white py-2 px-4 rounded-xl bottom-3 right-3 text-sm hidden" style="background-color: #0a8923e6">Votre profil a été mis à jour avec succès.
            </div>

            </div>
            <!-- /.col -->
            <div class="col-md-9">
              <div class="card">
                <div class="card-header p-2">
                  <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#personal_info" data-toggle="tab">Informations personnelles</a></li>
                    <li class="nav-item"><a class="nav-link" href="#change_password" data-toggle="tab">Changer le Mot de passe</a></li>
                    <li class="nav-item"><a class="nav-link" href="#historic_resa" data-toggle="tab">Historique des réservations</a></li>
                  </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane" id="personal_info">
                      <form class="form-horizontal" method="POST" action="{{ route('updateProfileInfo') }}" id="userProfileForm">
                        @csrf

                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">Nom</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputName" name="name" placeholder="Nom" value="{{ Auth::user()->name}}">
                            <span class="text-danger error-text name_error"></span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEmail" name="email" placeholder="Email" value="{{ Auth::user()->email}}" >
                            <span class="text-danger error-text email_error"></span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputName2" class="col-sm-2 col-form-label">Username</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputUsername" name="username" placeholder="username" value="{{ Auth::user()->username}}">
                            <span class="text-danger error-text username_error"></span>
                          </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPhone" class="col-sm-2 col-form-label">Téléphone</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="inputPhone" name="telephone" placeholder="Téléphone" value="{{ Auth::user()->telephone}}">
                              <span class="text-danger error-text telephone_error"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputCustomerProfile" class="col-sm-2 col-form-label">Profil Utilisateur</label>
                            <div class="col-sm-5">
                              <select class="form-control" id="inputCustomerProfile" name="customer_profile" value="">
                                <option value="b2c" @if(Auth::user()->customer_profile == "b2c") selected @endif >B to C</option>
                                <option value="b2b"  @if(Auth::user()->customer_profile == "b2b") selected @endif >B to B</option>
                                <option value="chic"  @if(Auth::user()->customer_profile == "chic") selected @endif >CHIC</option>
                              </select>
                              <span class="text-danger error-text customer_profile_error"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputShortDescription" class="col-sm-2 col-form-label">Description courte</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="inputShortDescription" name="short_description" placeholder="Description courte" value="{{ Auth::user()->short_description}}">
                              <span class="text-danger error-text short_description_error"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPresentation" class="col-sm-2 col-form-label">Présentation</label>
                            <div class="col-sm-10">
                              <textarea class="form-control" id="inputPresentation" name="presentation" placeholder="Présentation">{{ Auth::user()->presentation}}</textarea>
                              <span class="text-danger error-text presentation_error"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputVoyage" class="col-sm-2 col-form-label">Expériences Voyages</label>
                          <div class="col-sm-10">
                            <textarea class="form-control" id="inputVoyage" name="voyage" placeholder="expériences...">{{ Auth::user()->voyage}}</textarea>
                            <span class="text-danger error-text voyage_error"></span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputCulinaire" class="col-sm-2 col-form-label">Passions culinaires</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputCulinaire" name="culinaire" placeholder="passions..." value="{{ Auth::user()->culinaire}}" >
                            <span class="text-danger error-text culinaire_error"></span>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="inputPreferredLanguage" class="col-sm-2 col-form-label">Préférence de langue</label>
                          <div class="col-sm-5">
                            <select class="form-control" id="inputPreferredLanguage" name="prefered_language" value="">
                              <option value="FR" @if(Auth::user()->prefered_language == "FR") selected @endif >Français</option>
                              <option value="EN"  @if(Auth::user()->prefered_language == "EN") selected @endif >Anglais</option>
                              <option value="IT"  @if(Auth::user()->prefered_language == "IT") selected @endif >Italien</option>
                              <option value="DE"  @if(Auth::user()->prefered_language == "DE") selected @endif >Allemand</option>
                            </select>
                            <span class="text-danger error-text prefered_language_error"></span>
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

                    <!-- -------------------- Changement de Mot de passe ------------------ -->
                    <div class="tab-pane" id="change_password">
                        <form class="form-horizontal" action="{{ route('userChangePassword') }}" method="POST" id="userChangePasswordForm">
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Ancien Mot de passe</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="oldpassword" name="oldpassword" placeholder="Saisir votre mot de passe actuel">
                              <span class="text-danger error-text oldpassword_error"></span>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputEmail" class="col-sm-2 col-form-label">Nouveau Mot de passe</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="newpassword" name="newpassword" placeholder="Saisir le nouveau mot de passe">
                              <span class="text-danger error-text newpassword_error"></span>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName2" class="col-sm-2 col-form-label">Confirmer le Mot de passe</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="cnewpassword" name="cnewpassword" placeholder="Ressaisir le mot de passe">
                              <span class="text-danger error-text cnewpassword_error"></span>
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

                    <!-- -------------------- Historique des Réservations ------------------ -->
                    <div class="tab-pane" id="historic_resa">

                        <div class="col-md-12 drop-panel bloc-order-b2b">
                          <div class="">
                            <div class="well well_b2b grid panel" href="#myToggle" style="font-size: 14px; display: flex;flex-direction: row;">

                              <!-- BLOC DE GAUCHE : -->
                              <div class="col-md-6 well well_b2b_left">
                                <!-- Photo de l'établissement : -->
                                <a href="https://www.lescollectionneurs.com//castel-bois-marie-3945" target="_blank">
                                  <div class="img-container">
                                    <img style="height:auto;margin:auto;text-align:center; align:center;display:block; width:100%" class="lazyImg resultPhotoLead" src="https://media.lescollectionneurs.com/chc/hotels/lc-3945/search_result.jpg" alt="Chargement de la photo">
                                  </div>
                                </a>
                                <div class="grid-header">
                                  <!-- Nom de l'établissement : -->
                                  <a class="clearXhr" href="https://www.lescollectionneurs.com//castel-bois-marie-3945" target="_blank">
                                    <h4 class="title_reservations-b2b">
                                      Castel Bois Marie </h4>
                                  </a>
                                  <!-- Adresse de l'établissement : -->
                                  <p class="region hotelRegion">1083 Chemin de Bègue, Montauban (82000), Midi-Pyrénées</p>
                                </div>
                              </div>

                              <!-- BLOC DE DROITE : -->
                              <div class="col-md-6 well well-b2b-right">
                                <div class="">

                                  <!-- Numéro de la Réservation : -->
                                  <div class="blocNumeroResa col-xs-12">
                                    <p class="pull-left">
                                      Numéro de réservation </p>
                                    <p class="pull-right" style="font-weight: bold;">
                                      18985B0509484 : 9308SC000896
                                    </p>
                                  </div>
                                  <div class="blocTypeTarifAndRoomType col-xs-12">
                                    <!-- Type de Tarif : -->
                                    <div class="blocTypeTarif col-xs-12">
                                      <style>
                                        .blocTypeTarif {
                                          height: auto !important;
                                        }

                                      </style>
                                      <p class="">
                                        Tarif Préférentiel Les Collectionneurs </p>
                                    </div>

                                    <!-- Type de chambre : -->
                                    <div class="roomTypeName col-xs-12">
                                      <p class="p-roomTypeName">
                                        Emilio </p>
                                    </div>

                                  </div>

                                  <div class="blocNbrRoomAndDates col-xs-12">

                                    <!-- Calcul du nombre de guests pour la réservation: -->

                                    <!-- Nombre de chambres et de personnes : -->
                                    <div class="roomCountBloc col-xs-12">

                                      <!-- Nombre de chambres -->
                                      <div class="p-roomCount">
                                        <div class="p-roomCountLibelle text-left" style="width: 50%;display: inline-block;">
                                          Nombre de chambre(s) </div>
                                        <div class="p-roomCountLibelle text-right" style="width: 50%;display: inline-block; float: right;"><b>
                                            1 chambre</b>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="roomCountBloc second col-xs-12">
                                      <!-- Nombre de personnes -->
                                      <div class="p-personsCount">
                                        <div class="p-personsCountLibelle text-left" style="width: 50%;display: inline-block;">
                                          Nombre de personne(s) </div>
                                        <div class="p-personsCountLibelle text-right" style="width: 50%;display: inline-block;    float: right;"><b>
                                            2 personnes</b>
                                        </div>
                                      </div>
                                    </div>
                                    <!-- Dates du séjour : -->
                                    <div class="bookingDates col-xs-12">
                                      <div class="p-chekinoutDate">
                                        <div class="p-checkinoutDate-title text-left"  style="width: 50%;display: inline-block;">
                                          Dates de séjour </div>
                                        <div class="p-checkinoutDate-data text-right hidden-xs"  style="width: 50%;display: inline-block; float: right;">
                                          <strong>
                                            du 30 Jul 2021 au 31 Jul 2021 </strong>
                                        </div>

                                      </div>

                                      <div class="p-resaDate col-xs-12">
                                        <div class="p-resaDate-title text-left" style="width: 50%;display: inline-block;">
                                          Date de réservation </div>
                                        <div class="p-resaDate-data text-right" style="width: 50%;display: inline-block;float: right;">
                                          <strong>26 Jul 2021</strong>
                                        </div>
                                      </div>
                                      <div class="p-resaDate col-xs-12">
                                        <div class="p-resaDate-title text-left"  style="width: 50%;display: inline-block;">
                                          Statut </div>
                                        <div class="p-resaDate-data text-right" style="width: 50%;display: inline-block;float: right;">
                                          <strong>Réservation passée</strong>
                                        </div>
                                      </div>
                                    </div>

                                  </div>

                                  <!-- Prix de la Réservation : -->
                                  <div class="blocPrix col-xs-12 text-bottom">
                                    <p class="text-left"  style="width: 50%;display: inline-block;">
                                      <strong>PRIX TOTAL<span class="pointer" data-toggle="modal" href="#PopinCGV_Nightlyrate_18985B0509484">&nbsp;<i class="fa fa-info-circle orange"></i></span></strong>
                                    </p>
                                    <p class="text-right" style="width: 50%;display: inline-block;float: right;">
                                      <span class="text-right" style="font-weight: bold;">153.00 €</span>
                                    </p>
                                  </div>

                                  <div class="clearfix"></div>
                                  <div class="blocCreditsCollectes col-xs-12">
                                    <p class="text-left textPrix" style="width: 50%;display: inline-block;"><i class="fa fa-gift" aria-hidden="true"></i> Crédits collectés (estimation)</p>
                                    <p class="text-right textPrix" style="width: 50%;display: inline-block;float: right;"><b>4.59 €</b></p>
                                  </div>

                                  <div class="blocBtn col-xs-12">
                                    <div class="col-xs-12 col-sm-6 blocAnnuler text-left"  style="width: 50%;display: inline-block;">
                                      <a href="#" data-resa="18985B0509484" data-etab="3945" class="b2b_cancelresa">
                                        Annuler la réservation </a>
                                    </div>

                                    <div class="col-xs-12 col-sm-6  blocVoirHotel text-right" style="width: 50%;display: inline-block;float: right;">
                                      <a href="https://www.lescollectionneurs.com//castel-bois-marie-3945" id="b2b_seehotel" class="" target="_blank">
                                        Voir hôtel </a>
                                    </div>
                                  </div>

                                </div>
                              </div>
                            </div>
                          </div>

                        </div>


                    <div class="col-md-12 drop-panel bloc-order-b2b">
                            <div class="">
                              <div class="well well_b2b grid panel" href="#myToggle" style="font-size: 14px; display: flex;flex-direction: row;">

                                <!-- BLOC DE GAUCHE : -->
                                <div class="col-md-6 well well_b2b_left">
                                  <!-- Photo de l'établissement : -->
                                  <a href="https://www.lescollectionneurs.com//castel-bois-marie-3945" target="_blank">
                                    <div class="img-container">
                                      <img style="height:auto;margin:auto;text-align:center; align:center;display:block; width:100%" class="lazyImg resultPhotoLead" src="https://media.lescollectionneurs.com/chc/hotels/lc-3986/search_result.jpg" alt="Chargement de la photo">
                                    </div>
                                  </a>
                                  <div class="grid-header">
                                    <!-- Nom de l'établissement : -->
                                    <a class="clearXhr" href="https://www.lescollectionneurs.com//castel-bois-marie-3945" target="_blank">
                                      <h4 class="title_reservations-b2b">
                                        BDX Hôtel </h4>
                                    </a>
                                    <!-- Adresse de l'établissement : -->
                                    <p class="region hotelRegion">22 rue Charles Domercq, Bordeaux (33800), Aquitaine</p>
                                  </div>
                                </div>

                                <!-- BLOC DE DROITE : -->
                                <div class="col-md-6 well well-b2b-right">
                                  <div class="">

                                    <!-- Numéro de la Réservation : -->
                                    <div class="blocNumeroResa col-xs-12">
                                      <p class="pull-left">
                                        Numéro de réservation </p>
                                      <p class="pull-right" style="font-weight: bold;">
                                        18985B0495801 : 31546SC000022
                                      </p>
                                    </div>
                                    <div class="blocTypeTarifAndRoomType col-xs-12">
                                      <!-- Type de Tarif : -->
                                      <div class="blocTypeTarif col-xs-12">
                                        <style>
                                          .blocTypeTarif {
                                            height: auto !important;
                                          }

                                        </style>
                                        <p class="">
                                          Tarif Préférentiel Les Collectionneurs </p>
                                      </div>

                                      <!-- Type de chambre : -->
                                      <div class="roomTypeName col-xs-12">
                                        <p class="p-roomTypeName">
                                            BDX Accessible design </p>
                                      </div>

                                    </div>

                                    <div class="blocNbrRoomAndDates col-xs-12">

                                      <!-- Calcul du nombre de guests pour la réservation: -->

                                      <!-- Nombre de chambres et de personnes : -->
                                      <div class="roomCountBloc col-xs-12">

                                        <!-- Nombre de chambres -->
                                        <div class="p-roomCount">
                                          <div class="p-roomCountLibelle text-left" style="width: 50%;display: inline-block;">
                                            Nombre de chambre(s) </div>
                                          <div class="p-roomCountLibelle text-right" style="width: 50%;display: inline-block; float: right;"><b>
                                              1 chambre</b>
                                          </div>
                                        </div>
                                      </div>

                                      <div class="roomCountBloc second col-xs-12">
                                        <!-- Nombre de personnes -->
                                        <div class="p-personsCount">
                                          <div class="p-personsCountLibelle text-left" style="width: 50%;display: inline-block;">
                                            Nombre de personne(s) </div>
                                          <div class="p-personsCountLibelle text-right" style="width: 50%;display: inline-block;    float: right;"><b>
                                              2 personnes</b>
                                          </div>
                                        </div>
                                      </div>
                                      <!-- Dates du séjour : -->
                                      <div class="bookingDates col-xs-12">
                                        <div class="p-chekinoutDate">
                                          <div class="p-checkinoutDate-title text-left"  style="width: 50%;display: inline-block;">
                                            Dates de séjour </div>
                                          <div class="p-checkinoutDate-data text-right hidden-xs"  style="width: 50%;display: inline-block; float: right;">
                                            <strong>
                                                du 04 Jul 2021 au 05 Jul 2021 </strong>
                                          </div>

                                        </div>

                                        <div class="p-resaDate col-xs-12">
                                          <div class="p-resaDate-title text-left" style="width: 50%;display: inline-block;">
                                            Date de réservation </div>
                                          <div class="p-resaDate-data text-right" style="width: 50%;display: inline-block;float: right;">
                                            <strong>30 Jun 2021</strong>
                                          </div>
                                        </div>
                                        <div class="p-resaDate col-xs-12">
                                          <div class="p-resaDate-title text-left"  style="width: 50%;display: inline-block;">
                                            Statut </div>
                                          <div class="p-resaDate-data text-right" style="width: 50%;display: inline-block;float: right;">
                                            <strong>Réservation passée</strong>
                                          </div>
                                        </div>
                                      </div>

                                    </div>

                                    <!-- Prix de la Réservation : -->
                                    <div class="blocPrix col-xs-12 text-bottom">
                                      <p class="text-left"  style="width: 50%;display: inline-block;">
                                        <strong>PRIX TOTAL<span class="pointer" data-toggle="modal" href="#PopinCGV_Nightlyrate_18985B0509484">&nbsp;<i class="fa fa-info-circle orange"></i></span></strong>
                                      </p>
                                      <p class="text-right" style="width: 50%;display: inline-block;float: right;">
                                        <span class="text-right" style="font-weight: bold;">85.50 €</span>
                                      </p>
                                    </div>

                                    <div class="clearfix"></div>
                                    <div class="blocCreditsCollectes col-xs-12">
                                      <p class="text-left textPrix" style="width: 50%;display: inline-block;"><i class="fa fa-gift" aria-hidden="true"></i> Crédits collectés (estimation)</p>
                                      <p class="text-right textPrix" style="width: 50%;display: inline-block;float: right;"><b>2.57 €</b></p>
                                    </div>

                                    <div class="blocBtn col-xs-12">
                                      <div class="col-xs-12 col-sm-6 blocAnnuler text-left"  style="width: 50%;display: inline-block;">
                                        <a href="#" data-resa="18985B0509484" data-etab="3945" class="b2b_cancelresa">
                                          Annuler la réservation </a>
                                      </div>

                                      <div class="col-xs-12 col-sm-6  blocVoirHotel text-right" style="width: 50%;display: inline-block;float: right;">
                                        <a href="https://www.lescollectionneurs.com//castel-bois-marie-3945" id="b2b_seehotel" class="" target="_blank">
                                          Voir hôtel </a>
                                      </div>
                                    </div>

                                  </div>
                                </div>
                              </div>
                            </div>

                          </div>










                    <div class="col-md-12 drop-panel bloc-order-b2b">
                        <div class="">
                          <div class="well well_b2b grid panel" href="#myToggle" style="font-size: 14px; display: flex;flex-direction: row;">

                            <!-- BLOC DE GAUCHE : -->
                            <div class="col-md-6 well well_b2b_left">
                              <!-- Photo de l'établissement : -->
                              <a href="https://www.lescollectionneurs.com//castel-bois-marie-3945" target="_blank">
                                <div class="img-container">
                                  <img style="height:auto;margin:auto;text-align:center; align:center;display:block; width:100%" class="lazyImg resultPhotoLead" src="https://media.lescollectionneurs.com/chc/hotels/lc-3826/search_result.jpg" alt="Chargement de la photo">
                                </div>
                              </a>
                              <div class="grid-header">
                                <!-- Nom de l'établissement : -->
                                <a class="clearXhr" href="https://www.lescollectionneurs.com//castel-bois-marie-3945" target="_blank">
                                  <h4 class="title_reservations-b2b">
                                    Logis de la Cadène </h4>
                                </a>
                                <!-- Adresse de l'établissement : -->
                                <p class="region hotelRegion">3 Place du Marché au Bois, Saint-Émilion (33330), Aquitaine</p>
                              </div>
                            </div>

                            <!-- BLOC DE DROITE : -->
                            <div class="col-md-6 well well-b2b-right">
                              <div class="">

                                <!-- Numéro de la Réservation : -->
                                <div class="blocNumeroResa col-xs-12">
                                  <p class="pull-left">
                                    Numéro de réservation </p>
                                  <p class="pull-right" style="font-weight: bold;">
                                    18985B0452267 : 79122SC000733
                                  </p>
                                </div>
                                <div class="blocTypeTarifAndRoomType col-xs-12">
                                  <!-- Type de Tarif : -->
                                  <div class="blocTypeTarif col-xs-12">
                                    <style>
                                      .blocTypeTarif {
                                        height: auto !important;
                                      }

                                    </style>
                                    <p class="">
                                        Meilleur Tarif Disponible</p>
                                  </div>

                                  <!-- Type de chambre : -->
                                  <div class="roomTypeName col-xs-12">
                                    <p class="p-roomTypeName">
                                        1985</p>
                                  </div>

                                </div>

                                <div class="blocNbrRoomAndDates col-xs-12">

                                  <!-- Calcul du nombre de guests pour la réservation: -->

                                  <!-- Nombre de chambres et de personnes : -->
                                  <div class="roomCountBloc col-xs-12">

                                    <!-- Nombre de chambres -->
                                    <div class="p-roomCount">
                                      <div class="p-roomCountLibelle text-left" style="width: 50%;display: inline-block;">
                                        Nombre de chambre(s) </div>
                                      <div class="p-roomCountLibelle text-right" style="width: 50%;display: inline-block; float: right;"><b>
                                          1 chambre</b>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="roomCountBloc second col-xs-12">
                                    <!-- Nombre de personnes -->
                                    <div class="p-personsCount">
                                      <div class="p-personsCountLibelle text-left" style="width: 50%;display: inline-block;">
                                        Nombre de personne(s) </div>
                                      <div class="p-personsCountLibelle text-right" style="width: 50%;display: inline-block;    float: right;"><b>
                                          2 personnes</b>
                                      </div>
                                    </div>
                                  </div>
                                  <!-- Dates du séjour : -->
                                  <div class="bookingDates col-xs-12">
                                    <div class="p-chekinoutDate">
                                      <div class="p-checkinoutDate-title text-left"  style="width: 50%;display: inline-block;">
                                        Dates de séjour </div>
                                      <div class="p-checkinoutDate-data text-right hidden-xs"  style="width: 50%;display: inline-block; float: right;">
                                        <strong>
                                            du 04 Mar 2021 au 05 Mar 2021 </strong>
                                      </div>

                                    </div>

                                    <div class="p-resaDate col-xs-12">
                                      <div class="p-resaDate-title text-left" style="width: 50%;display: inline-block;">
                                        Date de réservation </div>
                                      <div class="p-resaDate-data text-right" style="width: 50%;display: inline-block;float: right;">
                                        <strong>22 Feb 2021</strong>
                                      </div>
                                    </div>
                                    <div class="p-resaDate col-xs-12">
                                      <div class="p-resaDate-title text-left"  style="width: 50%;display: inline-block;">
                                        Statut </div>
                                      <div class="p-resaDate-data text-right" style="width: 50%;display: inline-block;float: right;">
                                        <strong>Réservation passée</strong>
                                      </div>
                                    </div>
                                  </div>

                                </div>

                                <!-- Prix de la Réservation : -->
                                <div class="blocPrix col-xs-12 text-bottom">
                                  <p class="text-left"  style="width: 50%;display: inline-block;">
                                    <strong>PRIX TOTAL<span class="pointer" data-toggle="modal" href="#PopinCGV_Nightlyrate_18985B0509484">&nbsp;<i class="fa fa-info-circle orange"></i></span></strong>
                                  </p>
                                  <p class="text-right" style="width: 50%;display: inline-block;float: right;">
                                    <span class="text-right" style="font-weight: bold;">200 €</span>
                                  </p>
                                </div>

                                <div class="clearfix"></div>
                                <div class="blocCreditsCollectes col-xs-12">
                                  <p class="text-left textPrix" style="width: 50%;display: inline-block;"><i class="fa fa-gift" aria-hidden="true"></i> Crédits collectés (estimation)</p>
                                  <p class="text-right textPrix" style="width: 50%;display: inline-block;float: right;"><b>6 €</b></p>
                                </div>

                                <div class="blocBtn col-xs-12">
                                  <div class="col-xs-12 col-sm-6 blocAnnuler text-left"  style="width: 50%;display: inline-block;">
                                    <a href="#" data-resa="18985B0509484" data-etab="3945" class="b2b_cancelresa">
                                      Annuler la réservation </a>
                                  </div>

                                  <div class="col-xs-12 col-sm-6  blocVoirHotel text-right" style="width: 50%;display: inline-block;float: right;">
                                    <a href="https://www.lescollectionneurs.com//castel-bois-marie-3945" id="b2b_seehotel" class="" target="_blank">
                                      Voir hôtel </a>
                                  </div>
                                </div>

                              </div>
                            </div>
                          </div>
                        </div>

                      </div>


                      <div class="col-md-12 drop-panel bloc-order-b2b">
                        <div class="">
                          <div class="well well_b2b grid panel" href="#myToggle" style="font-size: 14px; display: flex;flex-direction: row;">

                            <!-- BLOC DE GAUCHE : -->
                            <div class="col-md-6 well well_b2b_left">
                              <!-- Photo de l'établissement : -->
                              <a href="https://www.lescollectionneurs.com//castel-bois-marie-3945" target="_blank">
                                <div class="img-container">
                                  <img style="height:auto;margin:auto;text-align:center; align:center;display:block; width:100%" class="lazyImg resultPhotoLead" src="https://media.lescollectionneurs.com/chc/hotels/lc-323/search_result.jpg" alt="Chargement de la photo">
                                </div>
                              </a>
                              <div class="grid-header">
                                <!-- Nom de l'établissement : -->
                                <a class="clearXhr" href="https://www.lescollectionneurs.com//castel-bois-marie-3945" target="_blank">
                                  <h4 class="title_reservations-b2b">
                                    Hostellerie le Castellas </h4>
                                </a>
                                <!-- Adresse de l'établissement : -->
                                <p class="region hotelRegion">30, Grand-Rue, Collias (30210), Languedoc-Roussillon</p>
                              </div>
                            </div>

                            <!-- BLOC DE DROITE : -->
                            <div class="col-md-6 well well-b2b-right">
                              <div class="">

                                <!-- Numéro de la Réservation : -->
                                <div class="blocNumeroResa col-xs-12">
                                  <p class="pull-left">
                                    Numéro de réservation </p>
                                  <p class="pull-right" style="font-weight: bold;">
                                    18985B0428010 : 68158SC000046
                                  </p>
                                </div>
                                <div class="blocTypeTarifAndRoomType col-xs-12">
                                  <!-- Type de Tarif : -->
                                  <div class="blocTypeTarif col-xs-12">
                                    <style>
                                      .blocTypeTarif {
                                        height: auto !important;
                                      }

                                    </style>
                                    <p class="">
                                        Soiree Etape</p>
                                  </div>

                                  <!-- Type de chambre : -->
                                  <div class="roomTypeName col-xs-12">
                                    <p class="p-roomTypeName">
                                        Chambre Standard Double</p>
                                  </div>

                                </div>

                                <div class="blocNbrRoomAndDates col-xs-12">

                                  <!-- Calcul du nombre de guests pour la réservation: -->

                                  <!-- Nombre de chambres et de personnes : -->
                                  <div class="roomCountBloc col-xs-12">

                                    <!-- Nombre de chambres -->
                                    <div class="p-roomCount">
                                      <div class="p-roomCountLibelle text-left" style="width: 50%;display: inline-block;">
                                        Nombre de chambre(s) </div>
                                      <div class="p-roomCountLibelle text-right" style="width: 50%;display: inline-block; float: right;"><b>
                                          1 chambre</b>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="roomCountBloc second col-xs-12">
                                    <!-- Nombre de personnes -->
                                    <div class="p-personsCount">
                                      <div class="p-personsCountLibelle text-left" style="width: 50%;display: inline-block;">
                                        Nombre de personne(s) </div>
                                      <div class="p-personsCountLibelle text-right" style="width: 50%;display: inline-block;    float: right;"><b>
                                          2 personnes</b>
                                      </div>
                                    </div>
                                  </div>
                                  <!-- Dates du séjour : -->
                                  <div class="bookingDates col-xs-12">
                                    <div class="p-chekinoutDate">
                                      <div class="p-checkinoutDate-title text-left"  style="width: 50%;display: inline-block;">
                                        Dates de séjour </div>
                                      <div class="p-checkinoutDate-data text-right hidden-xs"  style="width: 50%;display: inline-block; float: right;">
                                        <strong>
                                            du 19 Sep 2020 au 20 Sep 2020 </strong>
                                      </div>

                                    </div>

                                    <div class="p-resaDate col-xs-12">
                                      <div class="p-resaDate-title text-left" style="width: 50%;display: inline-block;">
                                        Date de réservation </div>
                                      <div class="p-resaDate-data text-right" style="width: 50%;display: inline-block;float: right;">
                                        <strong>09 Sep 2020</strong>
                                      </div>
                                    </div>
                                    <div class="p-resaDate col-xs-12">
                                      <div class="p-resaDate-title text-left"  style="width: 50%;display: inline-block;">
                                        Statut </div>
                                      <div class="p-resaDate-data text-right" style="width: 50%;display: inline-block;float: right;">
                                        <strong>Réservation passée</strong>
                                      </div>
                                    </div>
                                  </div>

                                </div>

                                <!-- Prix de la Réservation : -->
                                <div class="blocPrix col-xs-12 text-bottom">
                                  <p class="text-left"  style="width: 50%;display: inline-block;">
                                    <strong>PRIX TOTAL<span class="pointer" data-toggle="modal" href="#PopinCGV_Nightlyrate_18985B0509484">&nbsp;<i class="fa fa-info-circle orange"></i></span></strong>
                                  </p>
                                  <p class="text-right" style="width: 50%;display: inline-block;float: right;">
                                    <span class="text-right" style="font-weight: bold;">187.00 €</span>
                                  </p>
                                </div>

                                <div class="clearfix"></div>
                                <div class="blocCreditsCollectes col-xs-12">
                                  <p class="text-left textPrix" style="width: 50%;display: inline-block;"><i class="fa fa-gift" aria-hidden="true"></i> Crédits collectés (estimation)</p>
                                  <p class="text-right textPrix" style="width: 50%;display: inline-block;float: right;"><b>5.61 €</b></p>
                                </div>

                                <div class="blocBtn col-xs-12">
                                  <div class="col-xs-12 col-sm-6 blocAnnuler text-left"  style="width: 50%;display: inline-block;">
                                    <a href="#" data-resa="18985B0509484" data-etab="3945" class="b2b_cancelresa">
                                      Annuler la réservation </a>
                                  </div>

                                  <div class="col-xs-12 col-sm-6  blocVoirHotel text-right" style="width: 50%;display: inline-block;float: right;">
                                    <a href="https://www.lescollectionneurs.com//castel-bois-marie-3945" id="b2b_seehotel" class="" target="_blank">
                                      Voir hôtel </a>
                                  </div>
                                </div>

                              </div>
                            </div>
                          </div>
                        </div>

                      </div>


                </div>


                    <!-- /.tab-pane -->

                </div>

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


    <style>
      .bloc-order-b2b {
        margin-left: 5px;
        margin-right: 5px;
      }

      .bloc-order-b2b {
        margin-bottom: 3%;
        border-width: 2px;
        border-style: solid;
        border-color: black;
        border-image: initial;
      }

      .bloc-order-b2b .row {
        margin-left: 0px;
        margin-right: 0px;
      }

      .bloc-order-b2b .well_b2b {
        margin-bottom: 0px;
        padding: 30px;
      }

      .well.well_b2b_left {
        padding-top: 0px;
        padding-left: 0px;
      }

      .well.well_b2b_left a {
        color: rgb(239, 125, 0);
        font-weight: bold;
        font-size: 0.875em;
        letter-spacing: 0.1em;
        line-height: 20px;
        /* font-family: Karla, Arial, sans-serif; */
      }

      .img-container {
        margin-bottom: 2%;
      }

      .grid-header {
        margin-top: 20px;
      }

      h4.title_reservations-b2b {
        /* font-family: Montserrat; */
        font-size: 20px;
        margin-bottom: 0px;
      }

      .title_reservations-b2b {
        color: black;
        text-transform: uppercase;
      }

      .region.hotelRegion {
        /* font-family: "Sorts Mill Goudy"; */
        font-size: 14px;
        font-style: italic;
        margin-top: 4px;
      }

      p.region {
        font-size: 14px;
        color: rgb(150, 140, 131);
      }

      .bloc-order-b2b .col-md-6 {
        width: 50%;
      }

      .blocNumeroResa {
        font-family: "Open Sans";
        text-transform: uppercase;
        padding-bottom: 15px;
        margin-bottom: 20px;
      }

      .pull-left {
        float: left !important;
      }

      .pull-right {
        float: right !important;
      }

      .blocTypeTarifAndRoomType {
        background-color: rgb(245, 244, 242);
        padding: 20px;
      }

      .blocTypeTarif {
        height: auto !important;
      }

      .blocTypeTarif {
        /*  font-family: "Sorts Mill Goudy", serif; */
        font-style: italic;
        font-size: 18px;
      }

      .p-roomTypeName {
        margin: 0px;
      }

      .blocNbrRoomAndDates {
        margin-top: 30px;
        padding-top: 30px;
        padding-bottom: 30px;
        border-top: 1px dashed rgb(206, 206, 206);
        border-bottom: 1px dashed rgb(206, 206, 206);
      }

      .roomCountBloc {
        padding-bottom: 5px;
      }

      .roomCountBloc.second {
        padding-bottom: 0px;
      }

      .bookingDates {
        margin-top: 15px;
      }

      .p-resaDate {
        margin-top: 10px;
      }

      .blocPrix {
        margin-top: 30px;
      }

      .blocCreditsCollectes {
        margin-top: 3%;
        font-size: 14px;
      }

      .blocBtn {
        padding-top: 4%;
      }

      .blocAnnuler {
        padding-top: 10px;
      }

      #b2b_seehotel {
        text-transform: uppercase;
        display: block;
        background-color: rgb(239, 125, 0);
        padding-right: 20px;
        padding-left: 20px;
        padding-top: 10px;
        padding-bottom: 10px;
        color: rgb(255, 255, 255);
        text-align: center;
        float: right;
        box-shadow: rgb(221, 96, 0) 0px 3px 0px 0px;
        width: 75%;
        text-decoration: none;
        transition: all 0.3s ease 0s;
      }

    </style>



</x-layout>
