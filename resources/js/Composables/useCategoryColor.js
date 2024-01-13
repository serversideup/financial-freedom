const colors = {
    'green': '#16B364',
    'purple': '#7A5AF8',
    'orange': '#EF6820',
    'gray': '#737373',
    'blue': '#2E90FA',
    'pink': '#EE46BC',
    'red': '#F63D68',
};

export const useCategoryColor = () => {
    const getCategoryColor = (categoryColor) => {
        return colors[categoryColor];
    }

    return {
        getCategoryColor,
    }
}