<?php
    // PieceRequest class defintion
    class PieceRequest
    {
        // Private properties
        private $pieceType;
        private $patternName;
        private $quantity;

        // Getters/Setters for the properties
        public function getPieceType() {
            return $this->pieceType;
        }
        
        public function getPatternName() {
            return $this->patterName;
        }

        public function getQuantity() {
            return $this->quantity;
        }

        public function setPieceType($type) {
            $this->pieceType = $type;
        }

        public function setPatternName($name) {
            $this->patterName = $name;
        }

        public function setQuantity($quantity) {
            $this->quantity = $quantity;
        }
    }
?>