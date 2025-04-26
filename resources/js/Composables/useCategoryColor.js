const colors = {
    'green': '#17B26A',
    'purple': '#6172F3',
    'orange': '#F79009',
    'gray': '#4E5BA6',
    'blue': '#2E90FA',
    'pink': '#EE46BC'
};

export const useCategoryColor = () => {
    const getCategoryColor = (categoryColor) => {
        return colors[categoryColor];
    }

    return {
        getCategoryColor,
    }
}