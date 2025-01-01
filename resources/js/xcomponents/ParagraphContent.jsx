import React from "react";

const ParagraphContent = ({
	children,
	textColor = "text-Gray-scale-02",
	textDirection = "text-right",
}) => {
	return (
		<p className={`regular-b1  ${textColor} ${textDirection}`}>{children}</p>
	);
};

export default ParagraphContent;
