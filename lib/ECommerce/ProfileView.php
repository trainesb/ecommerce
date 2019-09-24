<?php


namespace ECommerce;


class ProfileView extends View {

    private $user;

    public function __construct(User $user) {
        $this->user = $user;

        $this->setTitle("Profile");

    }

    public function present() {
        $name = $this->user->getName();
        $role = $this->user->getRole();
        $notes = $this->user->getNotes();
        $address = $this->user->getAddress();
        $phone = $this->user->getName();
        $email = $this->user->getEmail();
        return <<<HTML
<div class="user-card">
    <p>Name: $name</p>
    <p>Email: $email</p>
    <p>Phone: $phone</p>
    <p>Address: $address</p>
    <p>Notes: $notes</p>
    <p>Role: $role</p>
</div>
HTML;

    }
}