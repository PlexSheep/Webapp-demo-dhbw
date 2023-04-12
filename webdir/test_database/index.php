<?php
   /**
     * Return all rows in the stocks table
     * @return array
     */
    public function all() {
        $query = $this->pdo->query('SELECT id, bar, qux '
                . 'FROM foo '
                . 'ORDER BY bar');
        $foos = [];
        while ($row = $query->fetch(\PDO::FETCH_ASSOC)) {
            $stocks[] = [
                'id' => $row['id'],
                'bar' => $row['bar'],
                'company' => $row['company']
            ];
        }
        return $stocks;
    }
?>
