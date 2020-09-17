<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVerified = false;

    /**
     * @ORM\OneToMany(targetEntity=Session::class, mappedBy="creatorUser")
     */
    private $sessions;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $gender;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $lastName;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $birthDate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $zipCode;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $companyName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $job;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $profession;

    /**
     * @ORM\Column(type="string", length=250, nullable=true)
     */
    private $cityName;

    /**
     * @ORM\Column(type="string", length=250, nullable=true)
     */
    private $deviceSerialNumber;

    /**
     * @ORM\Column(type="string", length=250, nullable=true)
     */
    private $serialNumber;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $enableOauth;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $sessionTimeout;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $multipleSession;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $phoneValidated;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    private $phoneValidationCode;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $authentificationMode;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $enabled;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $confirmationToken;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $passwordRequestedAt;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $locked;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $expired;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $expiresAt;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $credentialsExpired;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $credentialsExpiredAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $lastLogin;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $lastFailedLogin;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $loginCount;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $failedLoginCount;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $lastFailedLoginCount;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isDietetic;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nutrilogUser;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $removed;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="removerUser")
     */
    private $removerUser;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $removedAt;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $heightUnit;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $weightUnit;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $volumUnit;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $tipsShown;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="creatorUser")
     * @ORM\JoinColumn(nullable=false)
     */
    private $creatorUser;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $modifierUser;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $modifiedAt;

    public function __construct()
    {
        $this->sessions = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->removerUser = new ArrayCollection();
        $this->creatorUser = new ArrayCollection();
        $this->modifaierUser = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    /**
     * @return Collection|Session[]
     */
    public function getSessions(): Collection
    {
        return $this->sessions;
    }

    public function addSession(Session $session): self
    {
        if (!$this->sessions->contains($session)) {
            $this->sessions[] = $session;
            $session->setCreatorUser($this);
        }

        return $this;
    }

    public function removeSession(Session $session): self
    {
        if ($this->sessions->contains($session)) {
            $this->sessions->removeElement($session);
            // set the owning side to null (unless already changed)
            if ($session->getCreatorUser() === $this) {
                $session->setCreatorUser(null);
            }
        }

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(?\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(?string $zipCode): self
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    public function setCompanyName(?string $companyName): self
    {
        $this->companyName = $companyName;

        return $this;
    }

    public function getJob(): ?string
    {
        return $this->job;
    }

    public function setJob(?string $job): self
    {
        $this->job = $job;

        return $this;
    }

    public function getProfession(): ?string
    {
        return $this->profession;
    }

    public function setProfession(?string $profession): self
    {
        $this->profession = $profession;

        return $this;
    }

    public function getCityName(): ?string
    {
        return $this->cityName;
    }

    public function setCityName(?string $cityName): self
    {
        $this->cityName = $cityName;

        return $this;
    }

    public function getDeviceSerialNumber(): ?string
    {
        return $this->deviceSerialNumber;
    }

    public function setDeviceSerialNumber(?string $deviceSerialNumber): self
    {
        $this->deviceSerialNumber = $deviceSerialNumber;

        return $this;
    }

    public function getSerialNumber(): ?string
    {
        return $this->serialNumber;
    }

    public function setSerialNumber(?string $serialNumber): self
    {
        $this->serialNumber = $serialNumber;

        return $this;
    }

    public function getEnableOauth(): ?bool
    {
        return $this->enableOauth;
    }

    public function setEnableOauth(?bool $enableOauth): self
    {
        $this->enableOauth = $enableOauth;

        return $this;
    }

    public function getSessionTimeout(): ?int
    {
        return $this->sessionTimeout;
    }

    public function setSessionTimeout(?int $sessionTimeout): self
    {
        $this->sessionTimeout = $sessionTimeout;

        return $this;
    }

    public function getMultipleSession(): ?bool
    {
        return $this->multipleSession;
    }

    public function setMultipleSession(?bool $multipleSession): self
    {
        $this->multipleSession = $multipleSession;

        return $this;
    }

    public function getPhoneValidated(): ?bool
    {
        return $this->phoneValidated;
    }

    public function setPhoneValidated(?bool $phoneValidated): self
    {
        $this->phoneValidated = $phoneValidated;

        return $this;
    }

    public function getPhoneValidationCode(): ?string
    {
        return $this->phoneValidationCode;
    }

    public function setPhoneValidationCode(?string $phoneValidationCode): self
    {
        $this->phoneValidationCode = $phoneValidationCode;

        return $this;
    }

    public function getAuthentificationMode(): ?string
    {
        return $this->authentificationMode;
    }

    public function setAuthentificationMode(?string $authentificationMode): self
    {
        $this->authentificationMode = $authentificationMode;

        return $this;
    }

    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function setEnabled(?bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function getConfirmationToken(): ?string
    {
        return $this->confirmationToken;
    }

    public function setConfirmationToken(?string $confirmationToken): self
    {
        $this->confirmationToken = $confirmationToken;

        return $this;
    }

    public function getPasswordRequestedAt(): ?\DateTimeInterface
    {
        return $this->passwordRequestedAt;
    }

    public function setPasswordRequestedAt(?\DateTimeInterface $passwordRequestedAt): self
    {
        $this->passwordRequestedAt = $passwordRequestedAt;

        return $this;
    }

    public function getLocked(): ?bool
    {
        return $this->locked;
    }

    public function setLocked(?bool $locked): self
    {
        $this->locked = $locked;

        return $this;
    }

    public function getExpired(): ?bool
    {
        return $this->expired;
    }

    public function setExpired(?bool $expired): self
    {
        $this->expired = $expired;

        return $this;
    }

    public function getExpiresAt(): ?\DateTimeInterface
    {
        return $this->expiresAt;
    }

    public function setExpiresAt(?\DateTimeInterface $expiresAt): self
    {
        $this->expiresAt = $expiresAt;

        return $this;
    }

    public function getCredentialsExpired(): ?bool
    {
        return $this->credentialsExpired;
    }

    public function setCredentialsExpired(?bool $credentialsExpired): self
    {
        $this->credentialsExpired = $credentialsExpired;

        return $this;
    }

    public function getCredentialsExpiredAt(): ?\DateTimeInterface
    {
        return $this->credentialsExpiredAt;
    }

    public function setCredentialsExpiredAt(?\DateTimeInterface $credentialsExpiredAt): self
    {
        $this->credentialsExpiredAt = $credentialsExpiredAt;

        return $this;
    }

    public function getLastLogin(): ?\DateTimeInterface
    {
        return $this->lastLogin;
    }

    public function setLastLogin(?\DateTimeInterface $lastLogin): self
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }

    public function getLastFailedLogin(): ?\DateTimeInterface
    {
        return $this->lastFailedLogin;
    }

    public function setLastFailedLogin(?\DateTimeInterface $lastFailedLogin): self
    {
        $this->lastFailedLogin = $lastFailedLogin;

        return $this;
    }

    public function getLoginCount(): ?int
    {
        return $this->loginCount;
    }

    public function setLoginCount(?int $loginCount): self
    {
        $this->loginCount = $loginCount;

        return $this;
    }

    public function getFailedLoginCount(): ?int
    {
        return $this->failedLoginCount;
    }

    public function setFailedLoginCount(?int $failedLoginCount): self
    {
        $this->failedLoginCount = $failedLoginCount;

        return $this;
    }

    public function getLastFailedLoginCount(): ?int
    {
        return $this->lastFailedLoginCount;
    }

    public function setLastFailedLoginCount(?int $lastFailedLoginCount): self
    {
        $this->lastFailedLoginCount = $lastFailedLoginCount;

        return $this;
    }

    public function getIsDietetic(): ?bool
    {
        return $this->isDietetic;
    }

    public function setIsDietetic(?bool $isDietetic): self
    {
        $this->isDietetic = $isDietetic;

        return $this;
    }

    public function getNutrilogUser(): ?string
    {
        return $this->nutrilogUser;
    }

    public function setNutrilogUser(?string $nutrilogUser): self
    {
        $this->nutrilogUser = $nutrilogUser;

        return $this;
    }

    public function getCreatorUser(): ?self
    {
        return $this->creatorUser;
    }

    public function setCreatorUser(?self $creatorUser): self
    {
        $this->creatorUser = $creatorUser;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(self $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setCreatorUser($this);
        }

        return $this;
    }

    public function removeUser(self $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getCreatorUser() === $this) {
                $user->setCreatorUser(null);
            }
        }

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getRemoved(): ?bool
    {
        return $this->removed;
    }

    public function setRemoved(bool $removed): self
    {
        $this->removed = $removed;

        return $this;
    }

    public function getRemoverUser(): ?self
    {
        return $this->removerUser;
    }

    public function setRemoverUser(?self $removerUser): self
    {
        $this->removerUser = $removerUser;

        return $this;
    }

    public function addRemoverUser(self $removerUser): self
    {
        if (!$this->removerUser->contains($removerUser)) {
            $this->removerUser[] = $removerUser;
            $removerUser->setRemoverUser($this);
        }

        return $this;
    }

    public function removeRemoverUser(self $removerUser): self
    {
        if ($this->removerUser->contains($removerUser)) {
            $this->removerUser->removeElement($removerUser);
            // set the owning side to null (unless already changed)
            if ($removerUser->getRemoverUser() === $this) {
                $removerUser->setRemoverUser(null);
            }
        }

        return $this;
    }

    public function getRemovedAt(): ?\DateTimeInterface
    {
        return $this->removedAt;
    }

    public function setRemovedAt(?\DateTimeInterface $removedAt): self
    {
        $this->removedAt = $removedAt;

        return $this;
    }

    public function getHeightUnit(): ?string
    {
        return $this->heightUnit;
    }

    public function setHeightUnit(?string $heightUnit): self
    {
        $this->heightUnit = $heightUnit;

        return $this;
    }

    public function getWeightUnit(): ?string
    {
        return $this->weightUnit;
    }

    public function setWeightUnit(?string $weightUnit): self
    {
        $this->weightUnit = $weightUnit;

        return $this;
    }

    public function getVolumUnit(): ?string
    {
        return $this->volumUnit;
    }

    public function setVolumUnit(?string $volumUnit): self
    {
        $this->volumUnit = $volumUnit;

        return $this;
    }

    public function getTipsShown(): ?bool
    {
        return $this->tipsShown;
    }

    public function setTipsShown(?bool $tipsShown): self
    {
        $this->tipsShown = $tipsShown;

        return $this;
    }

    public function addCreatorUser(self $creatorUser): self
    {
        if (!$this->creatorUser->contains($creatorUser)) {
            $this->creatorUser[] = $creatorUser;
            $creatorUser->setCreatorUser($this);
        }

        return $this;
    }

    public function removeCreatorUser(self $creatorUser): self
    {
        if ($this->creatorUser->contains($creatorUser)) {
            $this->creatorUser->removeElement($creatorUser);
            // set the owning side to null (unless already changed)
            if ($creatorUser->getCreatorUser() === $this) {
                $creatorUser->setCreatorUser(null);
            }
        }

        return $this;
    }

    public function getModifierUser(): ?self
    {
        return $this->modifierUser;
    }

    public function setModifierUser(?self $modifierUser): self
    {
        $this->modifierUser = $modifierUser;

        return $this;
    }

    public function getModifiedAt(): ?\DateTimeInterface
    {
        return $this->modifiedAt;
    }

    public function setModifiedAt(?\DateTimeInterface $modifiedAt): self
    {
        $this->modifiedAt = $modifiedAt;

        return $this;
    }

}
