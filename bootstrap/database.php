<?php

use Aura\Marshal\Manager as Marshal;
use Aura\Marshal\Type\Builder as TypeBuilder;
use Aura\Marshal\Relation\Builder as RelationBuilder;

$pdo = new PDO('sqlite:database.sqlite');

$bootstrapQuery = "CREATE TABLE IF NOT EXISTS sites(
   id         INTEGER   PRIMARY KEY AUTOINCREMENT,
   name       TEXT      NOT NULL
);";

$pdo->prepare($bootstrapQuery)->execute();

$marshal = new Marshal(
    new TypeBuilder,
    new RelationBuilder
);

$marshal->setType('sites', [
    'identity_field' => 'id',
    'entity_builder' => new \RouterOsStumbler\EntityBuilders\SiteBuilder()
]);

$marshal->setType('surveys', [
    'identity_field' => 'id'
    'entity_builder' => new \RouterOsStumbler\EntityBuilders\SurveyBuilder()
]);
$marshal->setRelation('sites', 'surveys', [
    'relationship'  => 'has_many',
    'native_field'  => 'id',
    'foreign_field' => 'site_id',
]);
$marshal->setRelation('surveys', 'sites', [
    'relationship'  => 'belongs_to',
    'foreign_type'  => 'sites',
    'native_field'  => 'site_id',
    'foreign_field' => 'id',
]);


