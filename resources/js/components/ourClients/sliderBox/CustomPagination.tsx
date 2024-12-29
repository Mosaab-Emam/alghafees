import React from "react";

const CustomPagination = ({ position }) => {
	return (
		<div className={`custom-pagination flex  absolute ${position}  z-10`}></div>
	);
};

export default CustomPagination;
