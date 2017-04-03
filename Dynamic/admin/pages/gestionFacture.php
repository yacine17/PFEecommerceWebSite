<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 03/04/2017
 * Time: 22:14
 */?>
<div class="gestionFacture">
    <div class="container">
        <h1 class="text-center">Gestion des factures</h1>
        <form>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Rechercher un produit">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <table class="table">
            <tr>
                <th>N° facture</th>
                <th>Client</th>
                <th>Prix TTC</th>
                <th>Date</th>
                <th>Etat paiment</th>
                <th>Etat livraison</th>
                <th></th>
            </tr>
            <tr>
                <td>23</td>
                <td>Younes</td>
                <td>15000.00 DA</td>
                <td>03/04/2017</td>
                <td>Réglée</td>
                <td>Livrée</td>
                <td>
                    <button class="btn btn-warning" data-toggle="modal" data-target="#factureModal">
                        <i class="fa fa-edit"></i>
                        Modifer
                    </button>
                </td>
            </tr>
            <tr>
                <td>23</td>
                <td>Younes</td>
                <td>15000.00 DA</td>
                <td>03/04/2017</td>
                <td>Réglée</td>
                <td>Livrée</td>
                <td>
                    <button class="btn btn-warning" data-toggle="modal" data-target="#factureModal">
                        <i class="fa fa-edit"></i>
                        Modifer
                    </button>
                </td>
            </tr>
            <tr>
                <td>23</td>
                <td>Younes</td>
                <td>15000.00 DA</td>
                <td>03/04/2017</td>
                <td>Réglée</td>
                <td>Livrée</td>
                <td>
                    <button class="btn btn-warning" data-toggle="modal" data-target="#factureModal">
                        <i class="fa fa-edit"></i>
                        Modifer
                    </button>
                </td>
            </tr>
            <tr>
                <td>23</td>
                <td>Younes</td>
                <td>15000.00 DA</td>
                <td>03/04/2017</td>
                <td>Réglée</td>
                <td>Livrée</td>
                <td>
                    <button class="btn btn-warning" data-toggle="modal" data-target="#factureModal">
                        <i class="fa fa-edit"></i>
                        Modifer
                    </button>
                </td>
            </tr>
            <tr>
                <td>23</td>
                <td>Younes</td>
                <td>15000.00 DA</td>
                <td>03/04/2017</td>
                <td>Réglée</td>
                <td>Livrée</td>
                <td>
                    <button class="btn btn-warning" data-toggle="modal" data-target="#factureModal">
                        <i class="fa fa-edit"></i>
                        Modifer
                    </button>
                </td>
            </tr>
        </table>
        <!--Start modal-->
        <div class="modal fade" id="factureModal" tabindex="-1" role="dialog" aria-labelledby="factureModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Facture n° 23</h4>
                    </div>
                    <form>
                        <div class="modal-body">
                            <table class="table">
                                <tr>
                                    <td>N° facture:</td>
                                    <td>23</td>
                                </tr>
                                <tr>
                                    <td>N° commande:</td>
                                    <td>15</td>
                                </tr>
                                <tr>
                                    <td>Prix sans taxes:</td>
                                    <td>12500.00 DA</td>
                                </tr>
                                <tr>
                                    <td>Taxe:</td>
                                    <td>2500.00 DA</td>
                                </tr>
                                <tr>
                                    <td>Prix TTC:</td>
                                    <td>15000.00 DA</td>
                                </tr>
                                <tr>
                                    <td>Date:</td>
                                    <td>03/04/2017</td>
                                </tr>
                                <tr>
                                    <td>Etat paiement:</td>
                                    <td>
                                        <select name="etatPaiment" class="form-control">
                                            <option value="1">Réglée</option>
                                            <option value="2">Non Réglée</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Etat livraison:</td>
                                    <td>
                                        <select name="etatLivraison" class="form-control">
                                            <option value="1">Livrée</option>
                                            <option value="2">Non livrée</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Employé:</td>
                                    <td>Mohammed</td>
                                </tr>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary">Sauvegarder</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--End Modal-->
    </div>
</div>
