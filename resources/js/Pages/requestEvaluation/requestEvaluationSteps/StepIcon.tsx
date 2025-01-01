import React from "react";

const StepIcon = ({ item, step }) => {
	return (
		<div
			className={`${
				step >= item.id
					? "bg-primary-600"
					: "bg-bg-01 border border-Gray-scale-01"
			} w-full h-[70px] flex items-center py-[14px] px-[15px] gap-[10px] self-stretch transition-colors duration-500 ease-linear`}>
			{React.cloneElement(item.icon, {
				children: React.Children.map(item.icon.props.children, (child) => {
					if (child.type === "g") {
						return React.cloneElement(child, {
							children: React.Children.map(
								child.props.children,
								(pathChild) => {
									if (pathChild.type === "path") {
										return React.cloneElement(pathChild, {
											fill: step >= item.id ? "#FFFFFF" : "#A8B2B5",
										});
									}
									return pathChild;
								}
							),
						});
					}
					if (child.type === "path") {
						return React.cloneElement(child, {
							fill: step >= item.id ? "#FFFFFF" : "#A8B2B5",
						});
					}
					return child;
				}),
			})}
		</div>
	);
};

export default StepIcon;
