import React from "react";

import "./Button.css";

const Button = ({
    variant = "primary",
    radius,
    className,
    onClick,
    disabled,
    children,
    type = "button",
}: {
    variant?: "primary" | "out-line";
    radius?: "left" | "right";
    className?: string;
    onClick?: () => void;
    disabled?: boolean;
    children?: React.ReactNode;
    type?: "button" | "submit" | "reset";
}) => {
    return (
        <button
            type={type}
            onClick={onClick}
            disabled={disabled}
            className={`btn ${
                radius === "right" ? "btn-rtl-radius" : "btn-ltr-radius"
            } ${
                variant === "primary" ? "btn-primary " : "btn-outline"
            } ${className}`}
        >
            {children}
        </button>
    );
};

export default Button;
