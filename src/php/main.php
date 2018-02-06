<?php

class main {

    /**
     * @var mysqli
     */
    private $db;

    /**
     * @var array links and names of the pages in the navigation
     */
    public $navigation = [
        "/"             => "Home",
        "/about/"       => "About me",
        "/projects/"    => "Projects",
        "/skills/"      => "Skills",
        "/contact/"     => "Contact"
    ];

    public function __construct($setupDb = false) {

        if ($setupDb) {
            $this->setupDb();
        }
    }

    /**
     * Get my current age
     *
     * @param  int $year
     * @param  int $month
     * @param  int $day
     *
     * @return int
     */
    public function get_age($year = 1999, $month = 6, $day = 19) {
        $age = date('Y') - $year;
        if (date('m') < $month || (date('m') == $month && date('d') < $day)) {
            $age -= 1;
        }

        return $age;
    }

    /**
     * Get file with version
     *
     * @param $file
     *
     * @return string
     */
    public function version($file) {
        return $file . '?' . filemtime($file);
    }

    /**
     * Get projects from database
     *
     * @param  int $limit
     *
     * @return bool|mixed
     */
    public function getProjects($limit = null) {
        if ($this->db == null) {
            return false;
        }

        // Build query
        $query = "SELECT * FROM projects ORDER BY project_id DESC";

        // Add limit when needed
        if ($limit != null) {
            $query .= " LIMIT $limit";
        }

        // Get projects
        $projects = $this->db->query($query)->fetch_all(MYSQLI_ASSOC);

        // Add project links
        foreach ($projects as &$project) {
            $project['project_links'] = $this->db->query("SELECT project_link_text, project_link_url FROM project_links WHERE project_link_project_id = " . $project['project_id'])->fetch_all(MYSQLI_ASSOC);
        }

        return $projects;
    }

    /**
     * Get skills from database
     *
     * @return array|bool
     */
    public function getSkills() {
        if ($this->db == null) {
            return false;
        }

        // Create array of different levels of skills
        $skills = [
            "day-to-day" => $this->db->query("SELECT skill_name FROM skills WHERE skill_more_experience = TRUE ORDER BY skill_name")->fetch_all(MYSQLI_ASSOC),
            "experience" => $this->db->query("SELECT skill_name FROM skills WHERE skill_more_experience = FALSE ORDER BY skill_name")->fetch_all(MYSQLI_ASSOC)
        ];

        return $skills;
    }

    /**
     * Get education things from the database
     *
     * @return array|bool
     */
    public function getEducation() {
        if ($this->db == null) {
            return false;
        }

        return $this->db->query("SELECT * FROM education ORDER BY education_start_year DESC, education_id DESC")->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Setup database connection
     *
     * @throws Exception
     */
    private function setupDb() {
        require "config.php";

        $this->db = new mysqli($db_credentials['host'], $db_credentials['username'], $db_credentials['password'], $db_credentials['db_name']);
        if ($this->db->connect_errno) {
            throw new Exception($this->db->connect_error, $this->db->connect_errno);
        }
        $this->db->set_charset("utf8");
    }
}
