<?php

declare(strict_types=1);

namespace App\Models;

class Utilisateur
{
    private int $id_utilisateur;
    private string $identifiant;
    private string $password;
    private string $adresse_mail;
    private string $role;

    public function __construct(
        int $id_utilisateur,
        string $identifiant,
        string $password,
        string $adresse_mail,
        string $role
    ) {
        $this->id_utilisateur = $id_utilisateur;
        $this->identifiant = $identifiant;
        $this->password = $password;
        $this->adresse_mail = $adresse_mail;
        $this->role = $role;
    }

    /**
     * Get the value of id_utilisateur
     *
     * @return int
     */
    public function getIdUtilisateur(): int
    {
        return $this->id_utilisateur;
    }

    /**
     * Set the value of id_utilisateur
     *
     * @param int $id_utilisateur
     *
     * @return self
     */
    public function setIdUtilisateur(int $id_utilisateur): self
    {
        $this->id_utilisateur = $id_utilisateur;
        return $this;
    }

    /**
     * Get the value of identifiant
     *
     * @return string
     */
    public function getIdentifiant(): string
    {
        return $this->identifiant;
    }

    /**
     * Set the value of identifiant
     *
     * @param string $identifiant
     *
     * @return self
     */
    public function setIdentifiant(string $identifiant): self
    {
        $this->identifiant = $identifiant;
        return $this;
    }

    /**
     * Get the value of password
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @param string $password
     *
     * @return self
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Get the value of adresse_mail
     *
     * @return string
     */
    public function getAdresseMail(): string
    {
        return $this->adresse_mail;
    }

    /**
     * Set the value of adresse_mail
     *
     * @param string $adresse_mail
     *
     * @return self
     */
    public function setAdresseMail(string $adresse_mail): self
    {
        $this->adresse_mail = $adresse_mail;
        return $this;
    }

    /**
     * Get the value of role
     *
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @param string $role
     *
     * @return self
     */
    public function setRole(string $role): self
    {
        $this->role = $role;
        return $this;
    }
}
