<?php namespace Tabea\Repositories;

/**
 * Interface StudyInterface
 * @package Tabea\Repositories
 */
interface StudyInterface
{
    public function getStudies();
    public function getStudyById($studyId);
    public function getStudiesManagedByUserId($userId);
    public function getStudiesAccessibleByUserId($userId);
    public function getStudiesByStateId($stateId);
    public function getStudiesByStateName($stateName);

    public function create
    public function updateWithValues(Study $study, $input);
}