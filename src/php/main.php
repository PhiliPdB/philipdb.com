<?php

class main {

    /**
     * @var mysqli
     */
    private $db;

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
        if (date('m') < $month) $age -= 1;
        elseif (date('m') == $month && date('d') < $day) $age -= 1;
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
     * Setup database connection
     */
    private function setupDb() {
        require "config.php";

        $this->db = new mysqli($db_credentials['host'], $db_credentials['username'], $db_credentials['password'], $db_credentials['db_name']);
        if ($this->db->connect_errno) {
            die("Connection failed: " . $this->db->connect_error);
        }
        $this->db->set_charset("utf8");
    }
}
