<?php
namespace RussellAlbin\Resume\Modle;
use RussellAlbin\Resume\Api\ResumeRepositoryInterface;
use RussellAlbin\Resume\Api\Data\ResumeInterface;

class ResumeRepository implements ResumeRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function save(ResumeInterface $resume)
    {
        // TODO: Implement save() method.
    }
    /**
     * {@inheritdoc}
     */
    public function get($resumeId)
    {
        // TODO: Implement get() method.
    }
    /**
     * {@inheritdoc}
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria)
    {
        // TODO: Implement getList() method.
    }
    /**
     * {@inheritdoc}
     */
    public function getById($resumeId)
    {
        // TODO: Implement getById() method.
    }
    /**
     * {@inheritdoc}
     */
    public function delete(ResumeInterface $resume)
    {
        // TODO: Implement delete() method.
    }
    /**
     * {@inheritdoc}
     */
    public function deleteById($resumeId)
    {
        // TODO: Implement deleteById() method.
    }
}