<?php
namespace App\Table;

class UtilisateurTable extends Table
{
    public function findByEmail(string $email): mixed
    {
        return $this->query(
            'SELECT * FROM utilisateur WHERE email = ? AND actif = 1',
            [$email],
            true
        );
    }

    public function emailExiste(string $email): bool
    {
        $result = $this->query(
            'SELECT utilisateur_id FROM utilisateur WHERE email = ?',
            [$email],
            true
        );
        return $result !== null;
    }

    public function creer(string $nom, string $prenom, string $telephone, string $numero_rue, string $rue, string $adresse_complementaire, string $code_postale, string $ville, string $email, string $password): void
    {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $this->query(
            'INSERT INTO utilisateur (nom, prenom, telephone, numero_rue, rue, adresse_complementaire, adresse_postale, ville, email, password, role_id, actif) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 2, 1)',
            [$nom, $prenom, $telephone, $numero_rue, $rue, $adresse_complementaire, $code_postale, $ville, $email, $hash]
        );
    }

    public function mettreAJour(int $id, string $nom, string $prenom, string $telephone, string $adresse, string $email, ?string $password = null): void
    {
        if ($password) {
            $hash = password_hash($password, PASSWORD_BCRYPT);
            $this->query(
                'UPDATE utilisateur SET nom = ?, prenom = ?, telephone = ?, adresse_postale = ?, email = ?, password = ? WHERE utilisateur_id = ?',
                [$nom, $prenom, $telephone, $adresse, $email, $hash, $id]
            );
        } else {
            $this->query(
                'UPDATE utilisateur SET nom = ?, prenom = ?, telephone = ?, adresse_postale = ?, email = ? WHERE utilisateur_id = ?',
                [$nom, $prenom, $telephone, $adresse, $email, $id]
            );
        }
    }

    public function findEmployes(): array
    {
        return $this->query('SELECT * FROM utilisateur WHERE role_id = 3 ORDER BY nom');
    }

    public function setActif(int $id, int $actif): void
    {
        $this->query('UPDATE utilisateur SET actif = ? WHERE utilisateur_id = ?', [$actif, $id]);
    }

    public function creerEmploye(string $nom, string $prenom, string $email, string $password): void
    {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $this->query(
            'INSERT INTO utilisateur (nom, prenom, email, password, role_id, actif, doit_changer_mdp) VALUES (?, ?, ?, ?, 3, 1, 1)',
            [$nom, $prenom, $email, $hash]
        );
    }

    public function modifierEmploye(int $id, string $nom, string $prenom, string $email): void
    {
        $this->query(
            'UPDATE utilisateur SET nom = ?, prenom = ?, email = ? WHERE utilisateur_id = ?',
            [$nom, $prenom, $email, $id]
        );
    }

    public function emailExistePourAutre(string $email, int $id): bool
    {
        $result = $this->query(
            'SELECT utilisateur_id FROM utilisateur WHERE email = ? AND utilisateur_id != ?',
            [$email, $id],
            true
        );
        return $result !== null;
    }

    public function setDoitChangerMdp(int $id, int $valeur): void
    {
        $this->query('UPDATE utilisateur SET doit_changer_mdp = ? WHERE utilisateur_id = ?', [$valeur, $id]);
    }

    public function creerAdmin(string $nom, string $prenom, string $email, string $password): void
    {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $this->query(
            'INSERT INTO utilisateur (nom, prenom, email, password, role_id, actif, doit_changer_mdp) VALUES (?, ?, ?, ?, 1, 1, 1)',
            [$nom, $prenom, $email, $hash]
        );
    }

    public function findAdmins(): array
    {
        return $this->query('SELECT * FROM utilisateur WHERE role_id = 1 ORDER BY nom');
    }

    public function compterAdminsActifs(): int
    {
        $result = $this->query(
            'SELECT COUNT(*) AS total FROM utilisateur WHERE role_id = 1 AND actif = 1',
            [],
            true
        );
        return (int) ($result['total'] ?? 0);
    }

    public function findClients(): array
    {
        return $this->query(
            'SELECT utilisateur.*, COUNT(commande.numero_commande) AS nb_commandes
             FROM utilisateur
             LEFT JOIN commande ON commande.utilisateur_id = utilisateur.utilisateur_id
             WHERE utilisateur.role_id = 2
             GROUP BY utilisateur.utilisateur_id
             ORDER BY utilisateur.nom'
        );
    }

    public function changerMotDePasse(int $id, string $nouveauPassword): void
    {
        $hash = password_hash($nouveauPassword, PASSWORD_BCRYPT);
        $this->query('UPDATE utilisateur SET password = ? WHERE utilisateur_id = ?', [$hash, $id]);
    }
}
