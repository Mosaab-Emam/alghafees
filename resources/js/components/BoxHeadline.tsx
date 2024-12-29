import React from "react";

const BoxHeadline = ({ headline, reverseColor }) => {
	return (
		<p className={`${reverseColor ? "text-primary-600" : ""} head-line-h3 `}>
			{headline}{" "}
			<span
				className={`${reverseColor ? "text-Black-01" : "text-primary-600"}`}>
				...
			</span>
		</p>
	);
};

export default BoxHeadline;
