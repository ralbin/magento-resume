## Installation instructions
* composer require russellalbin/resume dev-master
* php bin/magento module:enable RussellAlbin_Resume
* php bin/magento setup:upgrade

## This is my resume as a Magento 2 module

I am trying to put as many things as possible into this, so you can view my resume as a xml doc
(In progress) You can view it as values saved in a custom set of database tables
(Pending) You can view it using a CLI 

#### API Methods
    <route url="/V1/resume" method="POST">
        <service class="RussellAlbin\Resume\Api\ResumeRepositoryInterface" method="save"/>
        <resources>
            <resource ref="RussellAlbin_Resume::edit"/>
        </resources>
    </route>
    <route url="/V1/resume/:resumeId" method="GET">
        <service class="RussellAlbin\Resume\Api\ResumeRepositoryInterface" method="get"/>
        <resources>
            <resource ref="RussellAlbin_Resume::view"/>
        </resources>
    </route>
    <route url="/V1/resume" method="PUT">
        <service class="RussellAlbin\Resume\Api\ResumeRepositoryInterface" method="save"/>
        <resources>
            <resource ref="RussellAlbin_Resume::edit"/>
        </resources>
    </route>
    <route url="/V1/resume/:resumetId" method="DELETE">
        <service class="RussellAlbin\Resume\Api\ResumeRepositoryInterface" method="deleteById"/>
        <resources>
            <resource ref="RussellAlbin_Resume::edit"/>
        </resources>
    </route>
    <route url="/V1/resume/search" method="GET">
        <service class="RussellAlbin\Resume\Api\ResumeRepositoryInterface" method="getList"/>
        <resources>
            <resource ref="RussellAlbin_Resume::view"/>
        </resources>
    </route>

#### API Notes on expected parameters and return values
    /**
     * Save Resume
     *
     * @param \RussellAlbin\Resume\Api\Data\ResumeInterface $resume
     * @return int|null
     */
    public function save(\RussellAlbin\Resume\Api\Data\ResumeInterface $resume);

    /**
     * Get Resume
     *
     * @param int $resumeId
     * @return \RussellAlbin\Resume\Api\Data\ResumeInterface
     */
    public function get($resumeId);

    /**
     * Get Resume by ID
     *
     * @param $resumeId
     * @return \RussellAlbin\Resume\Api\Data\ResumeInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($resumeId);

    /**
     * Get product list
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Magento\Catalog\Api\Data\ProductSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * Delete Resume
     *
     * @param  \RussellAlbin\Resume\Api\Data\ResumeInterface $resume
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(\RussellAlbin\Resume\Api\Data\ResumeInterface $resume);

    /**
     * Delete Resume by ID.
     *
     * @param  mixed $resumeId
     * @return bool
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById($resumeId);

#### Sample Payload for POST
     { "resume": {
        "entity_id": "1",
         "firstname": "Joe",
         "lastname": "Smith",
         "description": "A different description",
         "email": "anewemail@whatever.com",
         "objective": "Something Else",
         "phone": "808-999-1212",
         "skills": "computers, baseball, parking cars and walking on the snow"
        }
     }
     
#### Sample Payload for PUT     
     { "resume": {
         "firstname": "Sally",
         "lastname": "Nihongo",
         "description": "A girly description",
         "email": "sally@abigcompany.com",
         "objective": "Eating, swearing and drinking water",
         "phone": "333-111-5555",
         "skills": "Yelling, dusting, math and air soft gun repair"
        }
     }
     
 #### Sample request for search  
  > https://example.test/rest/V1/resume/search/?searchCriteria[filter_groups][0][filters][0][field]=firstname&searchCriteria[filter_groups][0][filters][0][value]=%sal%&searchCriteria[filter_groups][0][filters][0][condition_type]=like  